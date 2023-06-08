<?php

namespace App\Http\Request\Admin\Products\Currency;

use Illuminate\Foundation\Http\FormRequest;

class StatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return permissionAdmin('status-currencies');

    }//end of authorize

    public function rules(): array
    {
        return [
            'id' => ['required', 'numeric', 'exists:currencies,id'],
        ];

    }//end of rules

}//end of class