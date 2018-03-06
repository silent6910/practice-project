<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // create permissions
        Permission::create(['name' => 'article_search']);

        // create roles and assign existing permissions
        $role = Role::create(['name' => config('role.defRole')]);

        $role = Role::create(['name' => config('role.premiumRole')]);
        $role->givePermissionTo(['article_search']);
    }
}