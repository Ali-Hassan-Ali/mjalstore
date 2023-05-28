<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubCategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'        => ['ar' => fake()->name(), 'en' => fake()->name()],
            'status'      => fake()->boolean(),
            'has_market'  => fake()->boolean(),
            'parent_id'   => Category::Factory(),
            'admin_id'    => Admin::Factory(),
            'color_1'     => '#' . str()->random(6),
            'color_2'     => '#' . str()->random(6),
            'description' => str()->random(200),
        ];

    }//end of run

}//end of class