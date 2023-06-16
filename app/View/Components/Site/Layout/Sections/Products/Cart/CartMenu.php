<?php

namespace App\View\Components\Site\Layout\Sections\Products\Cart;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Card;

class CartMenu extends Component
{
    public function __construct(
        public $card = [],
    ){
        $this->card = Card::first();

    }//end of fun

    public function render(): View | Closure | string
    {
        return view('components.site.layout.sections.products.cart.cart-menu');

    }//end of render

}//end of class