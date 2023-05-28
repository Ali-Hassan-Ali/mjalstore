<?php

namespace App\Http\Request\Admin\SubCategory;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Validation\Rule;

class SubCategoryRequest extends FormRequest
{

	public function authorize(): bool
    {
        if (in_array(request()->method(), ['PUT', 'PATCH'])) {
            
            return permissionAdmin('update-sub_categories');

        } else {

            return permissionAdmin('create-sub_categories');

        }//end of if

    }//end of authorize

    public function rules(): array
    {
        $rules = [
            'status'     => ['nullable', 'in:1,0'],
            'has_market' => ['nullable', 'in:1,0'],
            'parent_id'  => ['required', 'exists:categories,id'],
            'color_1'    => ['required', 'string'],
            'color_2'    => ['required', 'string'],
        ];

        if (in_array(request()->method(), ['PUT', 'PATCH'])) {
            
            $subCategory = request()->route()->parameter('sub_category');

            $rules['name.' . app()->getLocale()]        = ['required','string','min:2','max:15', UniqueTranslationRule::for('categories', 'name')->ignore($subCategory?->id)];
            $rules['description.' . app()->getLocale()] = ['required','string','min:2','max:900'];
            $rules['banner']                            = ['nullable','image'];

        } else {

            $rules['name.' . app()->getLocale()]        = ['required','string','min:2','max:15', UniqueTranslationRule::for('categories', 'name')];
            $rules['description.' . app()->getLocale()] = ['required','string','min:2','max:900'];
            $rules['banner']                            = ['required','image'];

        } //end of if

        return $rules;

    }//end of rules

    protected function prepareForValidation()
    {
        return request()->merge([
            'admin_id'  => auth('admin')->id(),
            'slug'      => str()->slug(request()->name[getLanguages('default')->code] ?? '', '-'),
            'status'    => request()->has('status'),
            'has_market'=> request()->has('status'),
        ]);

    }//end of prepare for validation

}//end of class