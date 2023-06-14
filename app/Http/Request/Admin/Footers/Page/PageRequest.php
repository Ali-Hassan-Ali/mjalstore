<?php

namespace App\Http\Request\Admin\Footers\Page;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Validation\Rule;

class PageRequest extends FormRequest
{

	public function authorize(): bool
    {
        if (in_array(request()->method(), ['PUT', 'PATCH'])) {
            
            return permissionAdmin('update-pages');

        } else {

            return permissionAdmin('create-pages');

        }//end of if

    }//end of authorize

    public function rules(): array
    {
        $rules = [
            'status'     => ['nullable', 'in:1,0'],
            'order'      => ['required', 'numeric'],
        ];

        if (in_array(request()->method(), ['PUT', 'PATCH'])) {

        	$page = request()->route()->parameter('page');

        	$rules['slug'] = ['nullable','string','min:2','max:30', Rule::unique('pages')->ignore($page->id)];

        } else {

        	$rules['slug'] = ['nullable','string','min:2','max:30', 'unique:pages'];

        }

        $rules['title.' . getLanguages('default')->code] 		   = ['required','string', 'min:2', 'max:255'];
        $rules['description_one.' . getLanguages('default')->code] = ['required','string'];
        $rules['description_tow.' . getLanguages('default')->code] = ['required','string'];

        return $rules;

    }//end of rules

    public function attributes(): array
    {
        $rules = [
            'slug'   => trans('admin.global.slug'),
            'status' => trans('admin.global.status'),
            'status' => trans('admin.global.status'),
            'order'  => trans('admin.global.order'),
        ];

        $rules['title.' . getLanguages('default')->code] = trans('admin.global.by', ['name' => trans('admin.global.title'), 'lang' => getLanguages('default')->name]);
        $rules['description_one.' . getLanguages('default')->code] = trans('admin.global.by', ['name' => trans('admin.footers.pages.description_one'), 'lang' => getLanguages('default')->name]);
        $rules['description_tow.' . getLanguages('default')->code] = trans('admin.global.by', ['name' => trans('admin.footers.pages.description_tow'), 'lang' => getLanguages('default')->name]);

        return $rules;

    }//end of attributes


    protected function prepareForValidation()
    {
        return request()->merge([
            'admin_id' => auth('admin')->id(),
            'slug'     => str()->slug(request()->title[getLanguages('default')->code] ?? '', '-'),
            'status'   => request()->has('status'),
        ]);

    }//end of prepare for validation

}//end of class