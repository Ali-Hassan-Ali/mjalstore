<?php

namespace App\Http\Request\Admin\Settings;

use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest
{

	public function authorize(): bool
    {
        return permissionAdmin('create-settings');

    }//end of authorize

    public function rules(): array
    {
    	$rules['faq_title_' . getLanguages('default')->code . '.*'] 	   = ['required','string','min:2','max:150'];
    	$rules['faq_description_' . getLanguages('default')->code . '.*']  = ['required','string','min:2'];

        return $rules;

    }//end of rules

}//end of class