<?php

namespace App\View\Components\Site\Layout\Sections\Products\Card;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Banner extends Component
{
    public function __construct(
        public $image = '',
    ){}

    public function render(): View | Closure | string
    {
        return view('components.site.layout.sections.products.card.banner');

    }//end of render

}//end of class