<?php

namespace App\View\Components\Site\Layout\Sections\FastPurchase;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DataPuch extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.site.layout.sections.fast-purchase.data-puch');
    }
}
