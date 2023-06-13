<?php

namespace App\View\Components\Site\Layout\Sections\Footer;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Page extends Component
{
    public function __construct(
        public $page = [],
    ){}

    public function render(): View | Closure | string
    {
        return view('components.site.layout.sections.footer.page');

    }//end of render

}//end of class