<?php

namespace App\Http\Request\Admin\Settings;

use Illuminate\Foundation\Http\FormRequest;

class MetaRequest extends FormRequest
{

	public function authorize(): bool
    {
        return permissionAdmin('create-settings');

    }//end of authorize

    public function rules(): array
    {
        $rules = [];

        $rules['meta_title.'. app()->getLocale()]        = ['required','string','min:2','max:50'];
        $rules['meta_description.' . app()->getLocale()] = ['required','string','min:2'];
        $rules['meta_logo']                              = ['required','image'];

        return $rules;

    }//end of rules

}//end of class