<?php

namespace App\Http\Request\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{

	public function authorize(): bool
    {
        if (in_array(request()->method(), ['PUT', 'PATCH'])) {
            
            return permissionAdmin('update-categories');

        } else {

            return permissionAdmin('create-categories');

        }//end of if

    }//end of authorize

    public function rules(): array
    {
        $rules = [
            'status'  => ['nullable', 'in:1,0'],
        ];

        if (in_array(request()->method(), ['PUT', 'PATCH'])) {
            
            $category = request()->route()->parameter('category');

            $rules['name.' . app()->getLocale()] = ['required','string','min:2','max:15', UniqueTranslationRule::for('categories', 'name')->ignore($category?->id)];
            $rules['logo']                       = ['nullable','image'];

        } else {

            $rules['name.' . app()->getLocale()] = ['required','string','min:2','max:15', UniqueTranslationRule::for('categories', 'name')];
            $rules['logo']                       = ['required','image'];

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