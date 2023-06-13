<?php

namespace App\Http\Request\Admin\Footers\Page;

use Illuminate\Foundation\Http\FormRequest;

class StatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return permissionAdmin('status-pages');

    }//end of authorize

    public function rules(): array
    {
        return [
            'id' => ['required', 'numeric', 'exists:pages,id'],
        ];

    }//end of rules

}//end of class
