<?php

namespace App\Http\Request\Admin\Footers\PaymentMethod;

use Illuminate\Foundation\Http\FormRequest;

class StatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return permissionAdmin('status-payment_methods');

    }//end of authorize

    public function rules(): array
    {
        return [
            'id' => ['required', 'numeric', 'exists:payment_methods,id'],
        ];

    }//end of rules

}//end of class