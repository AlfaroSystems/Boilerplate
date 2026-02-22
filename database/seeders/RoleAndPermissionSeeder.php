<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Limpiar caché de permisos
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Crear Permisos
        Permission::create(['name' => 'acceder-dashboard']);
        Permission::create(['name' => 'editar-perfil']);
        Permission::create(['name' => 'eliminar-cuenta']);
        Permission::create(['name' => 'gestionar-usuarios']);

        // Crear Roles y asignar permisos
        $roleAdmin = Role::create(['name' => 'Admin']);
        $roleAdmin->givePermissionTo(Permission::all());

        $roleUser = Role::create(['name' => 'Usuario']);
        $roleUser->givePermissionTo(['editar-perfil', 'eliminar-cuenta']);

        // Asignar rol al usuario de prueba si existe
        $user = User::where('email', 'test@example.com')->first();
        if ($user) {
            $user->assignRole($roleAdmin);
        }

        // Asignar rol a jon.virgi@gmail.com si existe
        $jon = User::where('email', 'jon.virgi@gmail.com')->first();
        if ($jon) {
            $jon->assignRole($roleAdmin);
        }
    }
}
