<?php

namespace App\Http\Request\Site\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;

    }//end of authorize

    public function rules(): array
    {
        $rules = [
            'name'  => ['required','min:2','max:30'],
            'email' => ['required','email','min:2','max:255', Rule::unique('users')->ignore(auth()->id())],
            'image' => ['nullable','sometimes','nullable','image'],
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