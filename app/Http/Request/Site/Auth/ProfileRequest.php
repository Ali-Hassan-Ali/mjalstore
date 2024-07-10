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
            'name'          => ['required','min:2','max:30'],
            'email'         => ['required','email','min:2','max:255', Rule::unique('users')->ignore(auth()->id())],
            'phone'         => ['required', 'string','min:2','max:25', Rule::unique('users')->ignore(auth()->id())],
            'phone_code'    => ['required', 'numeric','min:1'],
            'country_code'  => ['required', 'string','min:1'],
            'country_name'  => ['required', 'string','min:2'],
            'image'         => ['nullable','sometimes','nullable','image'],
        ];
 	
        return $rules;

    }//end of rulses

    public function attributes(): array
    {
        return [
            'name'  => trans('auth.name'),
            'email' => trans('auth.email'),
            'phone' => trans('auth.phone'),
            'image' => trans('admin.global.image'),
        ];

    }//end of attributes

}//end of Request