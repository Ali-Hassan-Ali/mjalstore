<?php

namespace App\Http\Request\Admin\Products\Card;

use Illuminate\Foundation\Http\FormRequest;

class StatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return permissionAdmin('status-cards');

    }//end of authorize

    public function rules(): array
    {
        return [
            'id' => ['required', 'numeric', 'exists:cards,id'],
        ];

    }//end of rules

}//end of class