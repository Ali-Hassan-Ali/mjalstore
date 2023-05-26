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
            'status'   => ['nullable', 'in:1,0'],
            'parent_id'=> ['required', 'exists:categories,id'],
        ];

        if (in_array(request()->method(), ['PUT', 'PATCH'])) {
            
            $category = request()->route()->parameter('category');

            $rules['name.' . app()->getLocale()] = ['required','string','min:2','max:15', UniqueTranslationRule::for('categories', 'name')->ignore($category?->id)];
            $rules['banner']                     = ['nullable','image'];

        } else {

            $rules['name.' . app()->getLocale()] = ['required','string','min:2','max:15', UniqueTranslationRule::for('categories', 'name')];
            $rules['banner']                     = ['required','image'];

        } //end of if

        return $rules;

    }//end of rules

    protected function prepareForValidation()
    {
        return request()->merge([
            'admin_id' => auth('admin')->id(),
            'slug'     => str()->slug(request()->name[getLanguages('default')->code] ?? '', '-'),
            'status'   => request()->has('status'),
        ]);

    }//end of prepare for validation

}//end of class