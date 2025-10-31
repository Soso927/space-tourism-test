<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Toujours vider le cache interne de Spatie avant d'altérer la matrice
        app(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        // --- Permissions (adaptées au TP Planètes)
        $perms = [
            'planets.view',
            'planets.create',
            'planets.edit',
            'planets.delete',
            'crews.view',
            'crews.create',
            'crews.edit',
            'crews.delete',
            'users.manage',
        ];

        foreach ($perms as $p) {
            Permission::firstOrCreate(['name' => $p, 'guard_name' => 'web']);
        }

        // --- Rôles
        $admin  = Role::firstOrCreate(['name' => 'admin',  'guard_name' => 'web']);
        $planetManager = Role::firstOrCreate(['name' => 'planetManager', 'guard_name' => 'web']);
        $crewManager = Role::firstOrCreate(['name' => 'crewManager', 'guard_name' => 'web']);

        // --- Matrice rôles → permissions
        $admin->syncPermissions(Permission::all());

        $planetManager->syncPermissions([
            'planets.view',
            'planets.create',
            'planets.edit',
            'planets.delete',
        ]);

        $crewManager->syncPermissions([
            'crews.view',
            'crews.create',
            'crews.edit',
            'crews.delete',
        ]);

        // Rafraîchir le cache des permissions
        app(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
