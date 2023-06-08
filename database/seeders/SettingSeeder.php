<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\Admin;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
    	$websitTitle = ['ar' => 'مجال استور', 'en' => 'mjastore'];
    	$websiDes    = ['ar' => 'مجال استور', 'en' => 'mjastore'];

    	saveTransSetting('websit_title', json_encode($websitTitle));
        saveTransSetting('websit_description', json_encode($websiDes));

    }//end of run

}//end of class