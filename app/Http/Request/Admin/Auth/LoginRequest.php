<?php

namespace App\Http\Request\Admin\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;

    }//end of authorize

    public function rules(): array
    {
        $loginType = filter_var(request()->get('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        $rules = [
            'password'   => ['required', 'string','min:2','max:255'],
        ];

        if ($loginType == 'email') {

            $rules['login'] = ['required', 'email', 'exists:admins,email'];

        } else {

            $rules['login'] = ['required', 'min:2', 'max:255', 'exists:admins,name'];

        }//end of if

        return $rules;

    }//end of rules

    public function attributes(): array
    {
        $loginType = filter_var(request()->get('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        return [
            'login'    => $loginType == 'email' ? trans('auth.email') : trans('auth.name'),
        ];

    }//end of attributes

}//end of Request