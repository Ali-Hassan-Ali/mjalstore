<?php

namespace App\View\Components\Site\Layout\Sections\Card;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Market extends Component
{
    public function __construct(
        public $subCategory = '',
        public $market      = '',
    ){
        $this->subCategory = $subCategory;
        $this->market      = $market;

    }//end of fun

    public function render(): View | Closure | string
    {
        return view('components.site.layout.sections.card.market');

    }//ebd of render

}//end of class