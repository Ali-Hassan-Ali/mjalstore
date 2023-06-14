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

            $rules['name.' . getLanguages('default')->code]        = ['required','string','min:2','max:15', UniqueTranslationRule::for('categories', 'name')->ignore($subCategory?->id)];
            $rules['title_card.' . getLanguages('default')->code]  = ['required','string','min:2','max:255', UniqueTranslationRule::for('categories', 'title_card')->ignore($subCategory?->id)];
            $rules['description.' . getLanguages('default')->code] = ['required','string','min:2','max:900'];
            $rules['banner'] = ['nullable','image'];

        } else {

            $rules['name.' . getLanguages('default')->code]        = ['required','string','min:2','max:15', UniqueTranslationRule::for('categories', 'name')];
            $rules['title_card.' . getLanguages('default')->code]  = ['required','string','min:2','max:255', UniqueTranslationRule::for('categories', 'title_card')];
            $rules['description.' . getLanguages('default')->code] = ['required','string','min:2','max:900'];
            $rules['banner'] = ['required','image'];

        } //end of if

        return $rules;

    }//end of rules

    public function attributes(): array
    {
        $rules = [
            'status'     => trans('admin.global.status'),
            'has_market' => trans('admin.sub_category.has_market'),
            'parent_id'  => trans('menu.category'),
            'color_1'    => trans('admin.sub_category.color_1'),
            'color_2'    => trans('admin.sub_category.color_2'),
            'banner'     => trans('admin.sub_category.banner'),
        ];

        $rules['name.' . getLanguages('default')->code] = trans('admin.global.by', ['name' => trans('admin.global.name'), 'lang' => getLanguages('default')->name]);
        $rules['description.' . getLanguages('default')->code] = trans('admin.global.by', ['name' => trans('admin.global.description'), 'lang' => getLanguages('default')->name]);
        $rules['title_card.' . getLanguages('default')->code] = trans('admin.global.by', ['name' => trans('admin.sub_category.title_card'), 'lang' => getLanguages('default')->name]);

        return $rules;

    }//end of attributes

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