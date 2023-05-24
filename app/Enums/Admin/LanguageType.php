<?php

namespace App\Enums\Admin;

enum LanguageType: string
{
    case LTR = 'LTR';
    case RTL = 'RTL';

    public static function array(): array
    {
    	return [
    		'LTR' => 'LTR',
    		'RTL' => 'RTL',
    	];

    }//end of fun

}//end of enum