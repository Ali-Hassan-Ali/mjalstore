<?php

namespace App\Http\Request\Admin\Settings;

use Illuminate\Foundation\Http\FormRequest;

class MediaRequest extends FormRequest
{
	public function authorize(): bool
    {
        return permissionAdmin('create-settings');

    }//end of authorize

    public function rules(): array
    {
        $rules = [
        	'media_facebook'        => ['nullable', 'string', 'url'],
        	'media_twitter'         => ['nullable', 'string', 'url'],
        	'media_instagram'       => ['nullable', 'string', 'url'],
        	'media_video_links'     => ['nullable', 'string', 'url'],
            'media_google_play'     => ['nullable', 'string', 'url'],
            'media_apple_store'     => ['nullable', 'string', 'url'],
        ];

        return $rules;

    }//end of rules

}//end of class