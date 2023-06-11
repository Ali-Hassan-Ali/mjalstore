<?php

namespace App\View\Components\Site\Layout\Sections\Auth\Profile;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MainData extends Component
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
        return view('components.site.layout.sections.auth.profile.main-data');
    }
}
