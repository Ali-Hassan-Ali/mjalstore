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
            return \App\Models\Language::where('default' , 1)->first();
        }
        return \App\Models\Language::all();

    }//en dof fun

}//end of exists

if (!function_exists('getCurrency')) {

    function getCurrency($default = false)
    {
        if($default) {
            return \App\Models\Currency::where('default' , 1)->first();
        }
        return \App\Models\Currency::all();

    }//en dof fun

}//end of exists

if (!function_exists('getNewPrice')) {

    function getNewPrice($price = 0)
    {
        $currencyPrice = session('currency_price') ?? 0;
        $currencyName  = session('currency_name') ?? '$';

        if ($currencyPrice == 0) {

            return number_format(preg_replace('/,/', '', $price), 2) . '$';
            
        } else {

            return number_format(preg_replace('/,/', '', $price * $currencyPrice), 2) . ' ' . $currencyName;

        }//end of if

    }//en dof fun

}//end of exists

//////////////////////////////// Setting //////////////////////

 if(!function_exists('getSetting')) {
    
    function getSetting($key)
    {
        $setting = \App\Models\Setting::where('key', $key)->first();
        if($setting) {
            return $setting->value;
        } else {
            $setting = \App\Models\Setting::create(['key' => $key]);
            return '';
        }

    }//en dof fun

 }//end of getSetting

 if(!function_exists('saveSetting')) {
    
    function saveSetting($key, $value = '')
    {
        $setting = \App\Models\Setting::where('key', $key)->first();
        if(!$setting) {
            return $setting = \App\Models\Setting::create(['key' => $key, 'value' => $value]);
        }
        return $setting->update(['value' => $value]);

    }//en dof fun

 }//end of getSetting

 if(!function_exists('getImageSetting')) {
    
    function getImageSetting($key)
    {
        if ($key == 'websit_logo' && empty(getSetting($key))) {
            return asset('site_assets/images/logo.svg');    
        }
        return asset('storage/' . getSetting($key));

    }//en dof fun

 }//end of getImageSetting

 if(!function_exists('getTransSetting')) {
    
    function getTransSetting($key, $lang)
    {
        $setting = \App\Models\Setting::where('key', $key)->first();
        if($setting) {
            if(!empty(json_decode($setting->value, true)[$lang])) {
                return json_decode($setting->value, true)[$lang];
            } else {
                return json_decode($setting->value, true)[app()->getLocale()] ?? '';
            }
        } else {
            $setting = \App\Models\Setting::create(['key' => $key]);
            return '';
        }

    }//en dof fun

 }//end of getTransSetting

 if(!function_exists('saveTransSetting')) {
    
    function saveTransSetting($key, $value)
    {
        $setting = \App\Models\Setting::where('key', $key)->first();
        if(!$setting) {
            $setting = \App\Models\Setting::create(['key' => $key, 'value' => $value]);  
        } 
        $setting->update(['value' => $value]);

    }//en dof fun

 }//end of getTransSetting

 if(!function_exists('getMulteSetting')) {
    
    function getMulteSetting($key, $name, $index, $lang)
    {
        $setting = \App\Models\Setting::where('key', $key)->first();

        if($setting) {

            if(!empty(json_decode(getSetting($key), true)[$name][$index][$lang])) {

                return json_decode(getSetting($key), true)[$name][$index][$lang];

            } else {

                return false;
            }

        } else {

            $setting = \App\Models\Setting::create(['key' => $key]);

            return '';

        }//end of if

    }//en dof fun

 }//end of getMulteSetting