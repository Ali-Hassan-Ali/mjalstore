<?php

namespace App\View\Components\Admin\DataTable;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Script extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $datatables = [],
    ){}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.data-table.script');
    }
}
