<?php

namespace App\Http\Controllers\Site\Auth;

use App\Http\Controllers\Controller;
use App\Http\Request\Site\Auth\LoginRequest;
use App\Http\Request\Site\Auth\RegisterRequest;
use App\Models\User;

class AuthController extends Controller
{
    public function loginPage()
    {
        if(!auth('web')->check()) {

            return view('site.auth.login');

        } else {

            return redirect()->route('site.auth.login.index');
        }

    }//end of index

    public function login(LoginRequest $request)
    {
        $login_type = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        $request->merge([
            $login_type => $request->input('login')
        ]);

        $credentials = $request->only($login_type, 'password');

        if (auth('web')->attempt($credentials, request()->has('remember'))) {

            return response(['login' => true, 'success' => __('site.login_successfully')]);

        } else {

            return response(['password' => true, 'password_message' => __('auth.password_invalid')]);

        }//end of if
        
    }//end of login

    public function register(RegisterRequest $request)
    {
        $validated = $request->safe()->except(['password']);
        $validated['password'] = bcrypt($request->password);

        User::create($validated);

        $credentials = $request->only('email', 'password');
        
        if (auth('web')->attempt($credentials, request()->has('remember'))) {

            return response(['login' => true, 'success' => __('site.login_successfully')]);

        } else {

            return response(['login' => false]);

        }//end of if
        
    }//end of login

    public function logout(\Request $request)
    {
        auth()->logout();
        return redirect()->route('site.index');

    }//end of logout

}//end of controller