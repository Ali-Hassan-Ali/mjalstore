<?php

namespace App\Http\Request\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{
	public function authorize(): bool
    {
        return permissionAdmin('delete-categories');

    }//end of authorize

    public function rules(): array
    {
        return [
            'record_ids.*' => ['required', 'Numeric', 'exists:categories,id'],
        ];

    }//end of rules

}//end of class