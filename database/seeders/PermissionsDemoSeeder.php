<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\Admin;
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
            'admin_id'   => Admin::first()->id,
        ]);

        \App\Models\Admin::factory(20)->create();
        \App\Models\Admin::whereNot('id', 1)->each(fn($admin) => $admin->assignRole('admin'));

        $permissions = ['home', 'admins', 'roles', 'languages', 'settings', 'categories', 'sub_categories', 'markets'];

        foreach ($permissions as $data) {

            $cruds = ['create','read','update','delete','status'];

            foreach ($cruds as $crud) {

                Permission::create(['guard_name' => 'admin', 'name' => $crud .'-' . $data]);

            }//end of each

        }//end of each

        $roleSuperAdmin = Role::where([
            'name'       => 'super_admin',
            'guard_name' => 'admin',
            'admin_id'   => Admin::first()->id
        ])->first();

        $roleSuperAdmin->givePermissionTo(Permission::all());

    }//end of run

}//end of class
