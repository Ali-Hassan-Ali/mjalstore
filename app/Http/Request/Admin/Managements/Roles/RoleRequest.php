<?php

namespace App\Http\Request\Admin\Managements\Role;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
{

	public function authorize(): bool
    {
        if (in_array(request()->method(), ['PUT', 'PATCH'])) {
            
            return permissionAdmin('update-roles');

        } else {

            return permissionAdmin('create-roles');

        }//end of if

    }//end of authorize

    public function rules(): array
    {
        $rules = [
            'permissions.*' => ['required','exists:permissions,name'],
            'admin_id'      => ['nullable','string','exists:admins,id'],
            'guard_name'    => ['nullable'],
        ];

        if (in_array(request()->method(), ['PUT', 'PATCH'])) {

            $role = request()->route()->parameter('role');

            $rules['name'] = ['required','string','min:2','max:30', Rule::unique('roles')->ignore($role->id)];

        } else {

            $rules['name'] = ['required','string','unique:roles','min:2','max:30'];

        } //end of if

        return $rules;

    }//end of rules

    protected function prepareForValidation()
    {
        return request()->merge([
            'admin_id'   => auth('admin')->id(),
            'guard_name' => 'admin',
        ]);

    }//end of prepare for validation

}//end of class