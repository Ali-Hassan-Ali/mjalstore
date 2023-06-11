<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            [
            'username'  => 'ali-hassan'
        ],[
            'name'      => 'name',
            'username'  => 'ali-hassan',
            'email'     => 'name@app.com',
            'password'  => bcrypt('password'),
            'status'    => 1,
        ]);

        User::factory()->count(20)->make();

    }//end of run

}//end of class