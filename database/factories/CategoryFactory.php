<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'      => ['ar' => fake()->name(), 'en' => fake()->name()],
            'status'    => fake()->boolean(),
            'admin_id'  => Admin::Factory(),
        ];

    }//end of run

}//end of class