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

        // 1. Permisos fijos de sistema
        $permisosFijos = [
            'acceder-dashboard',
            'editar-perfil',
            'eliminar-cuenta',
        ];

        foreach ($permisosFijos as $p) {
            Permission::firstOrCreate(['name' => $p]);
        }

        // 2. Descubrimiento Automático de Módulos (Basado en Carpetas de Vistas)
        $vistasPath = resource_path('views');
        $directorios = array_filter(glob($vistasPath . '/*'), 'is_dir');
        
        $carpetasIgnoradas = ['auth', 'layouts', 'components', 'profile'];

        foreach ($directorios as $path) {
            $nombreCarpeta = basename($path);
            
            if (!in_array($nombreCarpeta, $carpetasIgnoradas)) {
                // Crear permiso dinámico: gestionar-{nombre_carpeta}
                Permission::firstOrCreate(['name' => "gestionar-{$nombreCarpeta}"]);
            }
        }

        // 3. Crear Roles y asignar permisos
        $roleAdmin = Role::firstOrCreate(['name' => 'Admin']);
        $roleAdmin->syncPermissions(Permission::all());

        $roleUser = Role::firstOrCreate(['name' => 'Usuario']);
        $roleUser->syncPermissions(['acceder-dashboard', 'editar-perfil', 'eliminar-cuenta']);

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
