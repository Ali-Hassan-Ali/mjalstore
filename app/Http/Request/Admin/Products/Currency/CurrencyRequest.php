<?php

namespace App\Http\Request\Admin\Products\Currency;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Validation\Rule;

class CurrencyRequest extends FormRequest
{

	public function authorize(): bool
    {
        if (in_array(request()->method(), ['PUT', 'PATCH'])) {
            
            return permissionAdmin('update-currencies');

        } else {

            return permissionAdmin('create-currencies');

        }//end of if

    }//end of authorize

    public function rules(): array
    {
        $rules = [
            'status'  => ['nullable', 'in:1,0'],
            'default' => ['nullable', 'in:1,0'],
            'flag'    => ['required', 'string','min:1','max:5'],
        ];

        if (in_array(request()->method(), ['PUT', 'PATCH'])) {
            
            $currency = request()->route()->parameter('currency');

            $rules['name.' . app()->getLocale()] = ['required','string','min:2','max:5', UniqueTranslationRule::for('currencies')->ignore($currency?->id)];
            $rules['code']                       = ['required','string','min:2','max:5', Rule::unique('currencies')->ignore($currency->id)];

        } else {

            $rules['name.' . app()->getLocale()] = ['required','string','min:2','max:5', UniqueTranslationRule::for('currencies', 'name')];
            $rules['code']                       = ['required','string','min:2','max:5', 'unique:currencies'];

        } //end of if

        return $rules;

    }//end of rules

    protected function prepareForValidation()
    {
        return request()->merge([
            'admin_id'  => auth('admin')->id(),
            'status'    => request()->has('status'),
            'default'   => request()->has('default'),
        ]);

    }//end of prepare for validation

}//end of class