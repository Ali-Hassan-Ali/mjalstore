<?php

namespace App\Enums\Admin;

enum LanguageType: string
{
    case RTL = 'RTL';
    case LTR = 'LTR';

    public static function array(): array
    {
    	return [
    		'RTL' => 'RTL',
    		'LRT' => 'LRT',
    	];

    }//end of fun

}//end of enum