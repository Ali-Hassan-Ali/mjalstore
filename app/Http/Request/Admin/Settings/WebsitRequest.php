<?php

namespace App\Http\Request\Admin\Settings;

use Illuminate\Foundation\Http\FormRequest;

class WebsitRequest extends FormRequest
{

    public function authorize(): bool
    {
        return permissionAdmin('create-settings');

    }//end of authorize

    public function rules(): array
    {
        $rules = [];

        $rules['websit_title.'. app()->getLocale()]        = ['required','string','min:2','max:50'];
        $rules['websit_description.' . app()->getLocale()] = ['required','string','min:2'];
        $rules['websit_logo']                              = ['nullable','image'];

        return $rules;

    }//end of rules

}//end of class