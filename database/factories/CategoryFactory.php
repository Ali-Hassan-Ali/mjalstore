<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    function random_color_part() 
    {
        return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
    }

    function random_color() 
    {
        return $this->random_color_part() . $this->random_color_part() . $this->random_color_part();
    }

    public function definition(): array
    {

        return [
            'name'      => ['ar' => fake()->name(), 'en' => fake()->name()],
            'status'    => fake()->boolean(),
            'has_market'=> fake()->boolean(),
            'parent_id' => Category::Factory(),
            'admin_id'  => Admin::Factory(),
            'color_1'   => '#' . $this->random_color(),
            'color_2'   => '#' . $this->random_color(),
        ];

    }//end of run

}//end of class