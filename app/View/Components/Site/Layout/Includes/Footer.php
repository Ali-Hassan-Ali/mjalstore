<?php

namespace App\View\Components\Site\Layout\Includes;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Page;

class Footer extends Component
{
    public function __construct(
       public $pages = [],
    ){
        $this->pages = Page::orderBy('order')->pluck('title', 'slug');
    }

    public function render(): View | Closure | string
    {
        return view('components.site.layout.includes.footer');

    }//end of render 

}//end of class