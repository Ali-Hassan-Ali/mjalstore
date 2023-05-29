<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Admin;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Category::factory(20)->create();
        // factory(App\Model\Service::class, 1)->create();

        $data = [
            [
                'name'      => json_encode(['ar' => 'متاجر رقميه', 'en' => 'متاجر رقميه']),
                'status'    => 1,
                'slug'      => str()->slug('متاجر رقميه', '-'),
                'admin_id'  => Admin::first()?->id,
                'created_at'=> now(),
            ],
            [
                'name'      => json_encode(['ar' => 'منصات العاب', 'en' => 'منصات العاب']),
                'status'    => 1,
                'slug'      => str()->slug('منصات العاب', '-'),
                'admin_id'  => Admin::first()?->id,
                'created_at'=> now(),
            ],
            [
                'name'      => json_encode(['ar' => 'الاتصال والبينات', 'en' => 'الاتصال والبينات']),
                'status'    => 1,
                'slug'      => str()->slug('الاتصال والبينات', '-'),
                'admin_id'  => Admin::first()?->id,
                'created_at'=> now(),
            ],

            [
                'name'      => json_encode(['ar' => 'بطاقات تسوق', 'en' => 'بطاقات تسوق']),
                'status'    => 1,
                'slug'      => str()->slug('بطاقات تسوق', '-'),
                'admin_id'  => Admin::first()?->id,
                'created_at'=> now(),
            ],
            [
                'name'      => json_encode(['ar' => 'خدمات واشتراكات', 'en' => 'خدمات واشتراكات']),
                'status'    => 1,
                'slug'      => str()->slug('خدمات واشتراكات', '-'),
                'admin_id'  => Admin::first()?->id,
                'created_at'=> now(),
            ],
        ];

        Category::insert($data);

    }//end of run

}//end of class