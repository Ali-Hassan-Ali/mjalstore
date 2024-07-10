<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class CheckCurrentPassword implements Rule
{
    public function __construct(){}

    public function passes($attribute, $value)
    {
        return Hash::check($value, auth('admin')->user()->password);

    }//end of passes

    public function message()
    {
        return 'Current Password Miss match';

    }//end of message

}//end of class