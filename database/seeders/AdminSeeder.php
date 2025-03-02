<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Users data
        $users = [
            [
                'name' => 'SuperAdmin DashUI',
                'email' => 'superadmin@dashui.dev',
                'role' => 'SuperAdmin',
            ],
            [
                'name' => 'Admin DashUI',
                'email' => 'admin@dashui.dev',
                'role' => 'Admin',
            ],
            [
                'name' => 'Manager DashUI',
                'email' => 'manager@dashui.dev',
                'role' => 'Manager',
            ],
            [
                'name' => 'Mutant',
                'email' => 'mutant@dashui.dev',
                'role' => 'User',
            ]
        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']], // Check if email already exists
                [
                    'name' => $userData['name'],
                    'password' => Hash::make('password'),
                    'is_active' => '1',
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );

            // Assign role only if it doesn't already have it
            if (!$user->hasRole($userData['role'])) {
                $user->assignRole($userData['role']);
            }
        }
    }
}
