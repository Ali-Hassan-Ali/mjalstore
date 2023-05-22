<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name'     => 'Arabic',
                'dir'      => 'RTL',
                'code'     => 'ar',
                'default'  => 1,
            ],
            [
                'name'     => 'English',
                'dir'      => 'LTR',
                'code'     => 'en',
                'default'  => 0,
            ],

        ];

        \App\Models\Language::insert($data);

    }//end of run
    
}//end of class