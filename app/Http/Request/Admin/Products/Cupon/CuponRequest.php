<?php

namespace App\Http\Request\Admin\Products\Cupon;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Validation\Rule;

class CuponRequest extends FormRequest
{

	public function authorize(): bool
    {
        if (in_array(request()->method(), ['PUT', 'PATCH'])) {
            
            return permissionAdmin('update-cupons');

        } else {

            return permissionAdmin('create-cupons');

        }//end of if

    }//end of authorize

    public function rules(): array
    {
        return [
            'status'  	 => ['nullable', 'in:1,0'],
            'code'  	 => ['required', 'string', 'min:5','max:100'],
            'price'  	 => ['required', 'numeric'],
            'start_date' => ['required', 'date'],
            'end_date'   => ['required', 'date'],
        ];

    }//end of rules

    public function attributes(): array
    {  
        return [
            'status'     => trans('admin.global.status'),
            'code'    	 => trans('admin.global.code'),
            'price'   	 => trans('admin.products.cupons.price'),
            'start_date' => trans('admin.products.cupons.start_date'),
            'end_date'   => trans('admin.products.cupons.end_date'),
        ];

    }//end of attributes

    protected function prepareForValidation()
    {
        return request()->merge([
            'admin_id'  => auth('admin')->id(),
            'status'    => request()->has('status'),
        ]);

    }//end of prepare for validation

}//end of class