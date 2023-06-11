<?php

namespace App\Http\Controllers\Site\Auth;

use App\Http\Controllers\Controller;
use App\Http\Request\Site\Auth\LoginRequest;
use App\Models\User;

class ProfileController extends Controller
{
    public function index(User $user)
    {
        $breadcrumb = ['#' => trans('auth.profile')];

        return view('site.auth.profile', compact('breadcrumb'));

    }//end of logout

}//end of controller