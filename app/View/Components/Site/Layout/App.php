<?php

namespace App\View\Components\Site\Layout;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class App extends Component
{
    public function __construct() {}

    public function render(): View | Closure | string
    {
        return view('components.site.layout.app');
        
    }//end of render

}//end of class