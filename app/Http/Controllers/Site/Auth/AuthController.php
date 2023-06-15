<?php

namespace App\Http\Controllers\Site\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Request\Site\Auth\LoginRequest;
use App\Http\Request\Site\Auth\RegisterRequest;
use App\Models\User;

class AuthController extends Controller
{
    public function loginPage(): View | RedirectResponse
    {
        if(!auth('web')->check()) {

            return view('site.auth.login');

        } else {

            return redirect()->route('site.auth.login.index');
        }

    }//end of index

    public function login(LoginRequest $request): Application | Response | ResponseFactory
    {
        $login_type = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        $request->merge([
            $login_type => $request->input('login')
        ]);

        $credentials = $request->only($login_type, 'password');

        if (auth('web')->attempt($credentials, request()->has('remember'))) {

            return response(['login' => true, 'success' => __('admin.global.login_successfully')]);

        } else {

            return response(['password' => true, 'password_message' => __('auth.password_invalid')]);

        }//end of if
        
    }//end of login

    public function register(RegisterRequest $request): Application | Response | ResponseFactory
    {
        $validated = $request->safe()->except(['password']);
        $validated['password'] = bcrypt($request->password);

        User::create($validated);

        $credentials = $request->only('email', 'password');
        
        if (auth('web')->attempt($credentials, request()->has('remember'))) {

            return response(['login' => true, 'success' => __('admin.global.login_successfully')]);

        } else {

            return response(['login' => false]);

        }//end of if
        
    }//end of login

    public function logout(\Request $request): RedirectResponse
    {
        auth()->logout();
        return redirect()->route('site.index');

    }//end of logout

}//end of controller