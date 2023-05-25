<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        if(getLanguages()->count()) {

            if(!session('code')) {
                session('dir') ?? session()->put('dir', getLanguages('default')?->dir);
                session('code') ?? session()->put('code', getLanguages('default')->code);
            }

            app()->setLocale(session('code'));

        } else {

            app()->setLocale(app()->getLocale());

        }//en dof check

        return $next($request);

    }//end of handle

}//end of class
