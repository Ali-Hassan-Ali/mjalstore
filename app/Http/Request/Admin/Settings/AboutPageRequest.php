<?php

namespace App\Http\Request\Admin\Settings;

use Illuminate\Foundation\Http\FormRequest;

class AboutPageRequest extends FormRequest
{

	public function authorize(): bool
    {
        return permissionAdmin('create-settings');

    }//end of authorize

    public function rules(): array
    {
        $rules['about_page_image']                                        = ['nullable','image'];
        $rules['about_page_title.' . getLanguages('default')->code]       = ['nullable','string','min:2','max:50'];
        $rules['about_page_description.' . getLanguages('default')->code] = ['nullable','string'];

        return $rules;

    }//end of rules

}//end of class