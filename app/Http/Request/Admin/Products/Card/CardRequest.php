<?php

namespace App\Http\Request\Admin\Products\Card;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Validation\Rule;

class CardRequest extends FormRequest
{

	public function authorize(): bool
    {
        if (in_array(request()->method(), ['PUT', 'PATCH'])) {
            
            return permissionAdmin('update-cards');

        } else {

            return permissionAdmin('create-cards');

        }//end of if

    }//end of authorize

    public function rules(): array
    {
        $rules = [
            'status'     => ['nullable', 'in:1,0'],
            'quantity'   => ['required', 'numeric'],
            'balance'    => ['required', 'numeric'],
            'price'      => ['required', 'numeric'],
            'rating'     => ['required', 'numeric', 'min:0', 'max:7'],
            'market_id'  => ['nullable', 'exists:markets,id'],
            'category_id'=> ['required', 'exists:categories,id'],
        ];

        return $rules;

    }//end of rules

    protected function prepareForValidation()
    {
        return request()->merge([
            'admin_id'  => auth('admin')->id(),
            'slug'      => str()->uuid(),
            'status'    => request()->has('status'),
        ]);

    }//end of prepare for validation

}//end of class