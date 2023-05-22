<?php

namespace App\View\Components\Admin\DataTable;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use JetBrains\PhpStorm\NoReturn;

class Header extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $columns = [],
    ){}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.data-table.header');
    }
}
