<?php

namespace App\Http\Request\Admin\Managements\Language;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Validation\Rule;

class LanguageRequest extends FormRequest
{

	public function authorize(): bool
    {
        if (in_array(request()->method(), ['PUT', 'PATCH'])) {
            
            return permissionAdmin('update-languages');

        } else {

            return permissionAdmin('create-languages');

        }//end of if

    }//end of authorize

    public function rules(): array
    {
        $rules = [
            'status'  => ['nullable', 'in:1,0'],
            'admin_id'=> ['nullable','string','exists:admins,id'],
            'dir'     => ['required', 'in:RTL,LTR'],
        ];

        if (in_array(request()->method(), ['PUT', 'PATCH'])) {
            
            $language = request()->route()->parameter('language');

            $rules['name'] = ['required','string','min:2','max:20', Rule::unique('languages')->ignore($language->id)];
            $rules['code'] = ['required','string','min:2','max:6', Rule::unique('languages')->ignore($language->id)];
            $rules['flag'] = ['nullable','image'];

        } else {

            $rules['name'] = ['required','string','min:2','max:20', 'unique:languages'];
            $rules['code'] = ['required','string','min:2','max:6', 'unique:languages'];
            $rules['flag'] = ['required','image'];

        } //end of if

        return $rules;

    }//end of rules

    public function attributes(): array
    {
        return [
            'name'   => trans('admin.global.name'), 
            'status' => trans('admin.global.status'), 
            'dir'    => trans('admin.managements.languages.dir'), 
            'code'   => trans('admin.managements.languages.code'), 
            'flag'   => trans('admin.managements.languages.flag'), 
        ];

    }//end of attributes

    protected function prepareForValidation()
    {
        return request()->merge([
            'admin_id' => auth('admin')->id(),
            'status'   => request()->has('status'),
        ]);

    }//end of prepare for validation

}//end of class