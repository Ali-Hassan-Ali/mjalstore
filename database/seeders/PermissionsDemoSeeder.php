<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Role::create([
            'name'       => 'admin',
            'guard_name' => 'admin',
        ]);

        $permissions = ['home', 'admins', 'roles', 'languages', 'settings', 'categories'];

        foreach ($permissions as $data) {

            $cruds = ['create','read','update','delete','status'];

            foreach ($cruds as $crud) {

                Permission::create(['guard_name' => 'admin', 'name' => $crud .'-' . $data]);

            }//end of each

        }//end of each

        $roleSuperAdmin = Role::create([
            'name'       => 'super_admin',
            'guard_name' => 'admin',
        ]);

        $roleSuperAdmin->givePermissionTo(Permission::all());

    }//end of run

}//end of class
