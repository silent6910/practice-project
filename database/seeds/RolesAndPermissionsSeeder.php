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
        //todo 這邊權限是設計不夠完全的
        Permission::create(['name' => 'article_createBulletin']);

        // create roles and assign existing permissions
        $role = Role::create(['name' => config('role.defRole')]);

        $role = Role::create(['name' => config('role.premiumRole')]);
        $role->givePermissionTo(['article_search']);
    }
}
