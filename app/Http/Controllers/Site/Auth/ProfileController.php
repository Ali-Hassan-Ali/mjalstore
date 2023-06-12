<?php

namespace App\Http\Controllers\Site\Auth;

use App\Http\Controllers\Controller;
use App\Http\Request\Site\Auth\ProfileRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    public function index(User $user)
    {
        if(auth('web')->check()) {

            $breadcrumb = ['#' => trans('auth.profile'), "$user->username" => $user->username];

            return view('site.auth.profile', compact('breadcrumb'));

        } else {

            return redirect()->route('site.auth.login.index');
        }

    }//end of index

    public function update(ProfileRequest $request)
    {
        $validated = $request->safe()->except('image');

        if($request->has('image')) {

            auth('web')->user()->image != 'default.png' ? Storage::disk('public')->delete(auth('web')->user()->image) : '';

            $validated['image'] = request()->file('image')->store('users', 'public');

        }//end of if

        auth('web')->user()->update($validated);

        return response(__('site.updated_successfully'));

    }//end of update

}//end of controller