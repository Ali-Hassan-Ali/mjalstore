<?php

namespace App\Http\Request\Admin\Products\Market;

use Illuminate\Foundation\Http\FormRequest;

class StatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return permissionAdmin('status-markets');

    }//end of authorize

    public function rules(): array
    {
        return [
            'id' => ['required', 'numeric', 'exists:markets,id'],
        ];

    }//end of rules

}//end of class