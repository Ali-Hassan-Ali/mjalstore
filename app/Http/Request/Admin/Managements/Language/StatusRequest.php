<?php

namespace App\Http\Request\Admin\Managements\Language;

use Illuminate\Foundation\Http\FormRequest;

class StatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return permissionAdmin('status-languages');

    }//end of authorize

    public function rules(): array
    {
        return [
            'id' => ['required', 'numeric', 'exists:languages,id'],
        ];

    }//end of rules

}//end of class
