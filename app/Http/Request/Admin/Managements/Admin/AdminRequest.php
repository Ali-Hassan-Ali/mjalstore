<?php

namespace App\Http\Request\Admin\Managements\Admin;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Validation\Rule;

class AdminRequest extends FormRequest
{

	public function authorize(): bool
    {
        if (in_array(request()->method(), ['PUT', 'PATCH'])) {
            
            return permissionAdmin('update-admins');

        } else {

            return permissionAdmin('create-admins');

        }//end of if

    }//end of authorize

    public function rules(): array
    {
        $rules = [
            'name'       => ['required','min:2','max:30'],
            'status'     => ['nullable','in:1,0'],
            'roles.*'    => ['nullable','string','exists:roles,name'],
            'admin_id'   => ['required','string','exists:admins,id'],
        ];

        if (in_array(request()->method(), ['PUT', 'PATCH'])) {

            $admin = request()->route()->parameter('admin');

            $rules['email']                  = ['required','email','min:2','max:30', Rule::unique('admins')->ignore($admin->id)];
            $rules['image']                  = ['nullable','image'];
            $rules['password']               = ['nullable','min:6','max:30'];
            $rules['password_confirmation']  = ['nullable','same:password','min:6','max:30'];

        } else {

            $rules['email']                  = ['required','string','unique:admins','min:2','max:30'];
            $rules['image']                  = ['required','image'];
            $rules['password']               = ['required','min:6','max:30'];
            $rules['password_confirmation']  = ['required','same:password','min:6','max:30'];

        } //end of if

        return $rules;

    }//end of rules

    protected function prepareForValidation()
    {
        return request()->merge([
            'admin_id' => auth('admin')->id(),
            'status'   => request()->has('status'),
        ]);

    }//end of prepare for validation

}//end of class