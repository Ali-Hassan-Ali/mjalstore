<?php

namespace App\View\Components\Input;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextMultiple extends Component
{
    public function __construct(
        public $name     = '',
        public $type     = 'text',
        public $value    = '',
        public $label    = false,
        public $required = false,
        public $error    = '',
    ){}

    public function render(): View|Closure|string
    {
        return view('components.input.text-multiple');

    }//end of render

}//end of class
