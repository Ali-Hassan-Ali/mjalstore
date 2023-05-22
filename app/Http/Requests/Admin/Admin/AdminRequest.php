<?php

namespace App\Http\Requests\Admin\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminRequest extends FormRequest
{
    public function authorize(): bool
    {
        return false;

    }//end of authorize

    public function rules(): array
    {

        $rules = [
            'name'       => ['required','min:2','max:30'],
            'image'      => ['required','image'],
            'password'   => ['required','min:6','max:30'],
            'status'     => ['in:1,0'],
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            
            $admin = $this->route()->parameter('admin');

            $rules['email']    = ['required','email','min:2','max:30', Rule::unique('admins')->ignore($$admin->id)];

        } else {

            $rules['email']    = ['required','string','unique:admins','min:2','max:30'];

        } //end of if

        return $rules;

    }//end of rules

}//end of class