<?php

namespace App\Http\Requests\Admin\Admin;

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
            'id' => ['required', 'Numeric', 'exists:admins,id'],
        ];

    }//end of rules

}//endof class
