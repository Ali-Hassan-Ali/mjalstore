<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Market;
use App\Models\Admin;
use App\Models\Category;

class MarketSeeder extends Seeder
{
    public function run(): void
    {
        // Market::factory(20)->create();

        $data = [
            [
                'name'      => json_encode(['ar' => 'المتجر السعودي', 'en' => 'sudai market']),
                'status'    => 1,
                'slug'      => str()->slug('sudai market', '-'),
                'admin_id'  => Admin::first()?->id,
                'created_at'=> now(),
            ],
            [
                'name'      => json_encode(['ar' => 'المتجر الامركي', 'en' => 'amrken market']),
                'status'    => 1,
                'slug'      => str()->slug('amrken market', '-'),
                'admin_id'  => Admin::first()?->id,
                'created_at'=> now(),
            ],
            [
                'name'      => json_encode(['ar' => 'المتجر القطري', 'en' => 'quter market']),
                'status'    => 1,
                'slug'      => str()->slug('quter market', '-'),
                'admin_id'  => Admin::first()?->id,
                'created_at'=> now(),
            ],

            [
                'name'      => json_encode(['ar' => 'المتجر البرطاني', 'en' => 'united kingdom market']),
                'status'    => 1,
                'slug'      => str()->slug('united kingdom market', '-'),
                'admin_id'  => Admin::first()?->id,
                'created_at'=> now(),
            ],
            [
                'name'      => json_encode(['ar' => 'المتجر المصري', 'en' => 'egypt market']),
                'status'    => 1,
                'slug'      => str()->slug('egypt market', '-'),
                'admin_id'  => Admin::first()?->id,
                'created_at'=> now(),
            ],
        ];

        Market::insert($data);
        $subCategories = Category::subCategory()->get()->random(rand(2, 6))->pluck('id')->toArray();
        Market::each(fn($market) => $market->subCategories()->sync($subCategories));

    }//end of run

}//end of class