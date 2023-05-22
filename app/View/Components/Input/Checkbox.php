<?php

namespace App\View\Components\input;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Checkbox extends Component
{

    public function __construct(
        public $name     = '',
        public $label    = '',
        public $value    = false,
        public $required = false,
    ){}

    
    public function render(): View|Closure|string
    {
        return view('components.input.checkbox');

    }//end of render

}//end of class