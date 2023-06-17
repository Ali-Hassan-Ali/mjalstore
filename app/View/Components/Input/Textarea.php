<?php

namespace App\View\Components\Input;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Textarea extends Component
{

    public function __construct(
        public $col      = '',
        public $name     = '',
        public $value    = '',
        public $label    = '',
        public $required = false,
        public $disabled = false,
        public $hidden   = false,
        public $ckeditor = false,
        public $readonly = false,
        public $invalid  = '',
        public $rows     = '3',
    ){}

    public function render(): View | Closure | string
    {
        return view('components.input.textarea');

    }//end of render

}//end of class