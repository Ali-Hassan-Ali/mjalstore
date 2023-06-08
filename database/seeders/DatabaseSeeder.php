<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            PermissionsDemoSeeder::class,
            LanguageSeeder::class,
            SettingSeeder::class,
            CategorySeeder::class,
            SubCategorySeeder::class,
            MarketSeeder::class,
            CurrencySeeder::class,
        ]);

    }//end of run

}//en dof class