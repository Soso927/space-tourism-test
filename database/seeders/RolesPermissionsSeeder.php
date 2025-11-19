<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // --- Liste complète des permissions ---
        $permissions = [
            // Planètes
            'planets.view',
            'planets.create',
            'planets.update',
            'planets.delete',

            // Équipage (prévu pour la partie suivante)
            'crew.view',
            'crew.create',
            'crew.update',
            'crew.delete',

            // Technologies (prévu pour la suite aussi)
            'technologies.view',
            'technologies.create',
            'technologies.update',
            'technologies.delete',
        ];

        // Création des permissions si elles n'existent pas déjà
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // --- Création des rôles ---
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $gestionnairePlanetes = Role::firstOrCreate(['name' => 'planetManager']);
        $gestionnaireEquipage = Role::firstOrCreate(['name' => 'crewManager']);
        $gestionnaireTechnologies = Role::firstOrCreate(['name' => 'techManager']);

        // --- Attribution des permissions à chaque rôle ---
        // Admin a toutes les permissions
        $admin->givePermissionTo(Permission::all());

        // Gestionnaire de planètes : uniquement les permissions planètes
        $gestionnairePlanetes->givePermissionTo([
            'planets.view',
            'planets.create',
            'planets.update',
            'planets.delete',
        ]);

        // Équipage
        $gestionnaireEquipage->givePermissionTo([
            'crew.view',
            'crew.create',
            'crew.update',
            'crew.delete',
        ]);

        // Technologies
        $gestionnaireTechnologies->givePermissionTo([
            'technologies.view',
            'technologies.create',
            'technologies.update',
            'technologies.delete',
        ]);
    }
}
