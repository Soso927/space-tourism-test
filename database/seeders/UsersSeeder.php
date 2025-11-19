<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assure-toi que RolesPermissionsSeeder a tourné avant (DatabaseSeeder ci-dessous)
        $users = [
            // --- Ton compte principal 
            [
                'email' => 'sofiane@admin.com',
                'name' => 'sofiane',
                'password' => '123456789',  
                'role' => 'admin',
            ],

            // --- Démo / tests
            [
                'email' => 'admin@example.com',
                'name'  => 'Admin Demo',
                'password' => 'password',
                'role'  => 'admin',
            ],
            [
                'email' => 'planet@example.com',
                'name'  => 'Titi Planet',
                'password' => 'titititi',
                'role'  => 'planetManager',
            ],
            [
                'email' => 'crew@example.com',
                'name'  => 'Tata Crew',
                'password' => 'tatatata',
                'role'  => 'crewManager',
            ],
        ];


        foreach ($users as $u) {
            $newUser = User::updateOrCreate(
                ['email' => $u['email']],
                [
                    'name'              => $u['name'],
                    'password'          => Hash::make($u['password']),
                    'email_verified_at' => now(),
                ]
            );

            // Nécessite que les rôles existent déjà (donc on seed d'abord RolesPermissionsSeeder)
            $newUser->syncRoles([$u['role']]);
        }
    }
}
