<?php

namespace App\Http\Request\Admin\Footers\PaymentMethod;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Validation\Rule;

class PaymentMethodRequest extends FormRequest
{

	public function authorize(): bool
    {
        if (in_array(request()->method(), ['PUT', 'PATCH'])) {
            
            return permissionAdmin('update-payment_methods');

        } else {

            return permissionAdmin('create-payment_methods');

        }//end of if

    }//end of authorize

    public function rules(): array
    {
        $rules = [
            'status' => ['nullable', 'in:1,0'],
            'order'  => ['required', 'numeric'],
        ];

        if (in_array(request()->method(), ['PUT', 'PATCH'])) {

            $rules['image'] = ['nullable', 'image'];

        } else {

            $rules['image'] = ['required', 'image'];
        }

        return $rules;

    }//end of rules

    public function attributes(): array
    {
        return [
            'status' => trans('admin.global.status'),
            'order'  => trans('admin.global.order'),
            'image'  => trans('admin.global.image'),
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