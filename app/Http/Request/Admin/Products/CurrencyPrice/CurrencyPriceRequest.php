<?php

namespace App\Http\Request\Admin\Products\CurrencyPrice;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Validation\Rule;

class CurrencyPriceRequest extends FormRequest
{

	public function authorize(): bool
    {
        if (in_array(request()->method(), ['PUT', 'PATCH'])) {
            
            return permissionAdmin('update-currency_prices');

        } else {

            return permissionAdmin('create-currency_prices');

        }//end of if

    }//end of authorize

    public function rules(): array
    {
        if (in_array(request()->method(), ['PUT', 'PATCH'])) {
            
            return [
                'price' => ['required', 'numeric'],
            ];

        } else {

            request()->merge(['currency_id.*' => array_keys([request()->price])]);

            return [
                'price.*'       => ['required', 'numeric'],
                'currency_id.*' => ['required', 'exists:currencies,id'],
            ];

        }//end of if

    }//end of rules

    public function attributes(): array
    {  
        return [
            'price.*'       => trans('admin.global.price'),
            'price'         => trans('admin.global.price'),
            'currency_id.*' => trans('admin.global.currencies'),
            'currency_id'   => trans('admin.global.currencies'),
        ];

    }//end of attributes

    protected function prepareForValidation()
    {
        return request()->merge([
            'admin_id'      => auth('admin')->id(),
        ]);

    }//end of prepare for validation

}//end of class