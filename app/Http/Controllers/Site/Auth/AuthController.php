<?php

namespace App\Http\Controllers\Site\Auth;

use App\Http\Controllers\Controller;
use App\Http\Request\Site\Auth\LoginRequest;
use App\Models\User;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $login_type = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        $request->merge([
            $login_type => $request->input('login')
        ]);

        $credentials = $request->only($login_type, 'password');

        if (auth()->attempt($credentials, request()->has('remember'))) {

            session()->flash('success', __('site.login_successfully'));

            return response(['login' => true]);

        } else {

            return response(['password' => true, 'password_message' => __('auth.password_invalid')]);

        }//end of if
        
    }//end of login

    public function logout(\Request $request)
    {
        auth()->logout();
        return redirect()->route('site.index');

    }//end of logout

}//end of controller