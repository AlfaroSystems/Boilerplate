<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index(): View
    {
        Gate::authorize('gestionar-roles');
        $roles = Role::with('permissions')->get();
        return view('roles.index', compact('roles'));
    }

    public function create(): View
    {
        Gate::authorize('gestionar-roles');
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        Gate::authorize('gestionar-roles');
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array'
        ]);

        try {
            $role = Role::create(['name' => $request->name]);
            $role->syncPermissions(array_map('intval', $request->permissions));
        } catch (\Spatie\Permission\Exceptions\RoleAlreadyExists $e) {
            return back()->withErrors(['name' => 'El rol ya existe.'])->withInput();
        }

        return redirect()->route('roles.index')->with('status', 'Rol creado con éxito');
    }

    public function edit(Role $role): View
    {
        Gate::authorize('gestionar-roles');
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        return view('roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, Role $role)
    {
        Gate::authorize('gestionar-roles');
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'required|array'
        ]);

        $role->update(['name' => $request->name]);
        $role->syncPermissions(array_map('intval', $request->permissions));

        return redirect()->route('roles.index')->with('status', 'Rol actualizado con éxito');
    }

    public function destroy(Role $role)
    {
        Gate::authorize('gestionar-roles');
        if ($role->name === 'Admin') {
            return back()->with('error', 'No se puede eliminar el rol de Administrador');
        }
        $role->delete();
        return redirect()->route('roles.index')->with('status', 'Rol eliminado con éxito');
    }
}
