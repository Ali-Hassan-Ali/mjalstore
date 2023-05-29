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
        	'media_facebook'        => ['required', 'string', 'url'],
        	'media_twitter'         => ['required', 'string', 'url'],
        	'media_instagram'       => ['required', 'string', 'url'],
        	'media_video_links'     => ['required', 'string', 'url'],
            'media_google_play'     => ['required', 'string', 'url'],
            'media_apple_store'     => ['required', 'string', 'url'],
        ];

        return $rules;

    }//end of rules

}//end of class