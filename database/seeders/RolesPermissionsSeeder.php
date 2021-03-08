<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'objects.show']);
        Permission::create(['name' => 'objects.crud']);

        $role = Role::create(['name' => 'user']);
        $role->givePermissionTo('objects.show');
        $role->givePermissionTo('objects.crud');

        /*$role = Role::create(['name' => 'admin']);
        $role->givePermissionTo('objects.show');*/

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());
    }
}
