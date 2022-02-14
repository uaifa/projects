<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleHasPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::all();
        $adminRole = Role::where('name', 'Admin')->first();

        $adminRole->syncPermissions();

        foreach ($permissions as $permission) {
            $adminRole->givePermissionTo($permission['name']);
        }
    }
}
