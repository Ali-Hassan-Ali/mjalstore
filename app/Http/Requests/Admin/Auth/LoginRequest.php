<?php

namespace App\Http\Requests\Admin\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;

    }//end of authorize

    public function rules(): array
    {
        
        $loginType = filter_var(request()->get('login'), FILTER_VALIDATE_EMAIL)? 'email' : 'string';

        $rules = [
            'password'   => ['required', 'string','min:2','max:255'],
        ];

        if ($loginType == 'email') {

            $rules['login'] = ['required', 'email', 'exists:admins,email'];

        } else {

            $rules['name']  = ['required','min:2','max:255'];

        }//end of if

        return $rules;

    }//end of rules

}//end of Request