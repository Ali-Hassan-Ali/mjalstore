<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Admin::create([
            'name'      => 'name',
            'email'     => 'super_admin@app.com',
            'password'  => bcrypt('password'),
        ]);

        $admin->assignRole('super_admin');

        \App\Models\Admin::factory(20)->create();

    }//end of run

}//end of class