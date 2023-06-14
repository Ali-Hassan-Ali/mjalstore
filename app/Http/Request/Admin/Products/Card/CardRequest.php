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

    public function attributes(): array
    {
        return [
            'status'      => trans('admin.global.status'),
            'quantity'    => trans('admin.products.cards.quantity'),
            'balance'     => trans('admin.products.cards.balance'),
            'price'       => trans('admin.global.price'),
            'rating'      => trans('admin.products.cards.rating'),
            'market_id'   => trans('menu.markets'),
            'category_id' => trans('menu.categories'),
        ];

    }//end of attributes

    protected function prepareForValidation()
    {
        return request()->merge([
            'admin_id'  => auth('admin')->id(),
            'slug'      => str()->random(12),
            'status'    => request()->has('status'),
        ]);

    }//end of prepare for validation

}//end of class