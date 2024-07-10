<?php

namespace App\Http\Request\Site\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;

    }//end of authorize

    public function rules(): array
    {
        $rules = [
            'name'               => ['required', 'string','min:2','max:50'],
            'username'           => ['required', 'string','min:2','max:50', 'unique:users'],
            'email'              => ['required', 'string','min:2','max:50', 'unique:users'],
            'phone'              => ['required', 'string','min:2','max:25', 'unique:users'],
            'phone_code'         => ['required', 'numeric','min:1'],
            'country_code'       => ['required', 'string','min:1'],
            'country_name'       => ['required', 'string','min:2'],
            'password'           => ['required', 'string','min:6','max:50'],
            'status'             => ['required', 'in:1'],
        ];

        return $rules;

    }//end of rules

    public function attributes(): array
    {
        return [
            'name'     => trans('auth.email'),
            'email'    => trans('auth.email'),
            'phone'    => trans('auth.phone'),
            'password' => trans('auth.password'),
        ];

    }//end of attributes

    protected function prepareForValidation()
    {
        return $this->merge(['username' => request()->name . '-' . str()->random(6), 'status' => true]);

    }//end of prepare for validation

}//end of Request