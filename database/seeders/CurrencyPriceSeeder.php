<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class CurrencyPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
        	[
                'name'      => json_encode(['ar' => 'د.ا', 'en' => 'D.A']),
                'code'      => 'DA',
                'default'   => 1,
                'status'    => 1,
                'created_at'=> now(),
                'admin_id'  => Admin::first()?->id,
            ],
            [
                'name'      => json_encode(['ar' => 'ر.س', 'en' => 'R.S']),
                'code'      => 'RS',
                'default'   => 0,
                'status'    => 1,
                'created_at'=> now(),
                'admin_id'  => Admin::first()?->id,
            ],
            [
                'name'      => json_encode(['ar' => 'ج.م', 'en' => 'E.G']),
                'code'      => 'eg',
                'default'   => 0,
                'status'    => 1,
                'created_at'=> now(),
                'admin_id'  => Admin::first()?->id,
            ],
            [
                'name'      => json_encode(['ar' => 'ر.ق', 'en' => 'R.K']),
                'code'      => 'RK',
                'default'   => 0,
                'status'    => 1,
                'created_at'=> now(),
                'admin_id'  => Admin::first()?->id,
            ],
            [
                'name'      => json_encode(['ar' => 'ج.ا', 'en' => 'G.I']),
                'code'      => 'GI',
                'default'   => 0,
                'status'    => 1,
                'created_at'=> now(),
                'admin_id'  => Admin::first()?->id,
            ],

        ];

        \App\Models\Currency::insert($data);

    }//end of run
    
}//end of class