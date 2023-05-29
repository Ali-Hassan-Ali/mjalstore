<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            PermissionsDemoSeeder::class,
            LanguageSeeder::class,
            CategorySeeder::class,
            SubCategorySeeder::class,
            MarketSeeder::class,
        ]);

    }//end of run

}//en dof class