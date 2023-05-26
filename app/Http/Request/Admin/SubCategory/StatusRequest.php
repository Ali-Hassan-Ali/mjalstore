<?php

namespace App\Http\Request\Admin\SubCategory;

use Illuminate\Foundation\Http\FormRequest;

class StatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return permissionAdmin('status-sub_categories');

    }//end of authorize

    public function rules(): array
    {
        return [
            'id' => ['required', 'numeric', 'exists:categories,id'],
        ];

    }//end of rules

}//end of class
