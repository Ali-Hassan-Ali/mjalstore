<?php

use \Illuminate\Database\Eloquent\Collection;


if (!function_exists('permission_admin')) {
    function permissionAdmin($permission = '')
    {

        if (auth('admin')->check()) {
            return auth('admin')->user()->can($permission);
        }
        return false;

    }//en dof fun

}//end of exists

if (!function_exists('getLanguages')) {

    function getLanguages($default = false)
    {
        if($default) {
            return \App\Models\Language::where('default' , '1')->first();
        }
        return \App\Models\Language::all();

    }//en dof fun

}//end of exists
