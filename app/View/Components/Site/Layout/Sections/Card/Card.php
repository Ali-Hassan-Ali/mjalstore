<?php

namespace App\View\Components\Site\Layout\Sections\Card;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    public function __construct(
        public $subCategory = '',
        public $card        = '',
    ){
        $this->subCategory = $subCategory;
        $this->card        = $card;

    }//end of fun

    public function render(): View | Closure | string
    {
        return view('components.site.layout.sections.card.card');

    }//ebd of render

}//end of class