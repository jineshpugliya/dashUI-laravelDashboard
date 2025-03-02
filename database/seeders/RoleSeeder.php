<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ensure roles are created only if they do not exist
        $roles = ['SuperAdmin', 'Admin', 'Manager', 'User'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Permissions creation
        $permissions = [
            'AdminPanel access' => ['Admin', 'Manager'],
            'User access' => [],
            'User create' => [],
            'User edit' => [],
            'User delete' => [],
            'Role access' => [],
            'Role create' => [],
            'Role edit' => [],
            'Role delete' => [],
            'Permission access' => [],
            'Permission create' => [],
            'Permission edit' => [],
            'Permission delete' => [],
        ];

        foreach ($permissions as $perm => $roles) {
            $permission = Permission::firstOrCreate(['name' => $perm]);
            foreach ($roles as $role) {
                $permission->assignRole($role);
            }
        }
    }
}
