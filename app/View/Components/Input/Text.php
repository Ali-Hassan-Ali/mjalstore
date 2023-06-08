<?php

namespace App\View\Components\Input;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Text extends Component
{
    public function __construct(
        public $id       = '',
        public $col      = '',
        public $name     = '',
        public $type     = 'text',
        public $value    = '',
        public $label    = '',
        public $required = false,
        public $disabled = false,
        public $hidden   = false,
        public $invalid  = '',
    ){
        $this->id = str_replace('.', '-', !empty($invalid) ? $invalid : $name);
    }

    public function render(): View|Closure|string
    {
        return view('components.input.text');

    }//end of render

}//end of class
