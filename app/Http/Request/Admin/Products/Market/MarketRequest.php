<?php

namespace App\Http\Request\Admin\Products\Market;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Validation\Rule;

class MarketRequest extends FormRequest
{

	public function authorize(): bool
    {
        if (in_array(request()->method(), ['PUT', 'PATCH'])) {
            
            return permissionAdmin('update-markets');

        } else {

            return permissionAdmin('create-markets');

        }//end of if

    }//end of authorize

    public function rules(): array
    {
        $rules = [
            'status'           => ['nullable', 'in:1,0'],
            'sub_categories.*' => ['required', 'exists:categories,id'],
        ];

        if (in_array(request()->method(), ['PUT', 'PATCH'])) {
            
            $market = request()->route()->parameter('market');

            $rules['name.' . app()->getLocale()] = ['required','string','min:2','max:15', UniqueTranslationRule::for('markets', 'name')->ignore($market?->id)];
            $rules['flag']                       = ['nullable','image'];

        } else {

            $rules['name.' . app()->getLocale()] = ['required','string','min:2','max:15', UniqueTranslationRule::for('markets', 'name')];
            $rules['flag']                       = ['required','image'];

        } //end of if

        return $rules;

    }//end of rules

    protected function prepareForValidation()
    {
        return request()->merge([
            'admin_id'  => auth('admin')->id(),
            'slug'      => str()->slug(request()->name[getLanguages('default')->code] ?? '', '-'),
            'status'    => request()->has('status'),
        ]);

    }//end of prepare for validation

}//end of class