<?php

namespace App\View\Components\Site\Layout\Sections\Products\Cart;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    public function __construct(
        public $card,
    ){}

    public function render(): View | Closure | string
    {
        return view('components.site.layout.sections.products.cart.button');

    }//end of  render

}//end of class