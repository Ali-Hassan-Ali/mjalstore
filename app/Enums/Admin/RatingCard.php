<?php

namespace App\Enums\Admin;

enum RatingCard: string
{
    public static function array(): array
    {
    	return [
    		1 => '🌟',
    		2 => '🌟🌟',
    		3 => '🌟🌟🌟',
    		4 => '🌟🌟🌟🌟',
    		5 => '🌟🌟🌟🌟🌟',
    		6 => '🌟🌟🌟🌟🌟🌟',
    		7 => '🌟🌟🌟🌟🌟🌟🌟',
    	];

    }//end of fun

}//end of enum