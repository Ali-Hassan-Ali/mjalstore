<?php

namespace App\View\Components\Site\Layout\Sections\Auth\Profile;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MainData extends Component
{
    public function __construct() {}

    public function render(): View | Closure | string
    {
        return view('components.site.layout.sections.auth.profile.main-data');
        
    }//end of render

}//end of class