<?php

namespace App\Http\Request\Admin\Settings;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{

	public function authorize(): bool
    {
        return permissionAdmin('create-settings');

    }//end of authorize

    public function rules(): array
    {
        $rules = [
        	'contact_phone'    		=> ['required', 'string', 'min:2', 'max:50'],
        	'contact_email'    		=> ['required', 'email', 'min:2', 'max:50'],
        	'contact_address'  		=> ['required', 'string', 'min:2', 'max:255'],
        	'contact_address_link'  => ['required', 'string', 'url'],
        ];

        return $rules;

    }//end of rules

}//end of class