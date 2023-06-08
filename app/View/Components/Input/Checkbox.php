<?php

namespace App\View\Components\Input;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Checkbox extends Component
{

    public function __construct(
        public $col      = '',
        public $name     = '',
        public $label    = '',
        public $value    = false,
        public $required = false,
        public $disabled = false,
        public $hidden   = false,
    ){}

    
    public function render(): View|Closure|string
    {
        return view('components.input.checkbox');

    }//end of render

}//end of class