<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            // Roles
            ['name' => 'Role View', 'guard_name' => 'web'],
            ['name' => 'Role Add', 'guard_name' => 'web'],
            ['name' => 'Role Edit', 'guard_name' => 'web'],
            ['name' => 'Role Delete', 'guard_name' => 'web'],
            ['name' => 'Role Permission Edit', 'guard_name' => 'web'],

            // Permissions
            ['name' => 'Permission View', 'guard_name' => 'web'],
            ['name' => 'Permission Add', 'guard_name' => 'web'],
            ['name' => 'Permission Edit', 'guard_name' => 'web'],
            ['name' => 'Permission Delete', 'guard_name' => 'web'],

            // Users
            ['name' => 'User View', 'guard_name' => 'web'],
            ['name' => 'User Add', 'guard_name' => 'web'],
            ['name' => 'User Edit', 'guard_name' => 'web'],
            ['name' => 'User Delete', 'guard_name' => 'web'],


        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
