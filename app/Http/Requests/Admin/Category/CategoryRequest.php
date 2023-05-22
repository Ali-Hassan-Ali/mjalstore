<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;

    }//end of authorize

    public function rules(): array
    {
        dd('gfgf');

        $rules = [
            'status'  => ['in:1,0'],
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            
            $category = $this->route()->parameter('category');

            $rules['name']    = ['required','string','min:2','max:15', Rule::unique('categories')->ignore($category->id)];

        } else {

            $rules['name']    = ['required','string','unique:users','min:2','max:15'];

        } //end of if

        return $rules;

    }//end of rules

}//end of class