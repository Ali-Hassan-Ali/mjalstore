<?php

namespace App\Http\Request\Admin\Managements\Language;

use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{
	public function authorize(): bool
    {
        return permissionAdmin('delete-languages');

    }//end of authorize

    public function rules(): array
    {
        return [
            'record_ids.*' => ['required', 'numeric', 'exists:languages,id'],
        ];

    }//end of rules

    protected function prepareForValidation()
    {
        return request()->merge([
            'ids'   => json_decode(request()->record_ids),
        ]);

    }//end of prepare for validation

}//end of class