<?php

namespace App\View\Components\Site\Layout\Includes;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModelAuth extends Component
{
    public function __construct() {}

    public function render(): View | Closure | string
    {
        return view('components.site.layout.includes.model-auth');

    }//end of render

}//end of class