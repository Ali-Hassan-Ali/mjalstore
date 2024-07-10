<?php

namespace App\View\Components\Site\Layout\Sections\Auth;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Scripts extends Component
{
    public function __construct() {}

    public function render(): View | Closure | string
    {
        return view('components.site.layout.sections.auth.scripts');

    }//end of render 

}//end of class