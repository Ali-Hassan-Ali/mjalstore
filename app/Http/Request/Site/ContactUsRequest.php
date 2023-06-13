<?php

namespace App\Http\Request\Site;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactUsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;

    }//end of authorize

    public function rules(): array
    {
        $rules = [
            'name'    => ['required','min:2','max:30'],
            'email'   => ['required','email','min:2','max:50'],
            'subject' => ['required','string','min:2','max:255'],
            'body'    => ['required','string'],
        ];
 	
        return $rules;

    }//end of rules

    public function attributes(): array
    {
        return [
            'name'  => trans('auth.name'),
            'email' => trans('auth.email'),
        ];

    }//end of attributes

}//end of Request