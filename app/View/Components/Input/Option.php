<?php

namespace App\View\Components\Input;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Option extends Component
{
    public function __construct(
        public $col      = '',
        public $name     = '',
        public $type     = 'text',
        public $value    = '',
        public $label    = '',
        public $required = false,
        public $disabled = false,
        public $hidden   = false,
        public $multiple = false,
        public $readonly = false,
        public $invalid  = '',
        public $lists    = [],
    ){}

    public function render(): View | Closure | string
    {
        return view('components.input.option');

    }//end of render

}//end of class