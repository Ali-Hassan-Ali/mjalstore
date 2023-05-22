<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;

class StatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return false;

    }//end of authorize

    public function rules(): array
    {
        return [
            'id'     => ['required', 'Numeric', 'exists:categories,id'],
            'status' => ['required', 'Numeric', 'in:1,0'],
        ];

    }//end of rules

}//end of class