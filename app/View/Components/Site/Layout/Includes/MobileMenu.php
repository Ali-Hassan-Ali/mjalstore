<?php

namespace App\View\Components\Site\Layout\Includes;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Category;

class MobileMenu extends Component
{
    public function __construct(
        public $categories = [],
    ){
        $this->categories = Category::category()->with('subCategoriesRelation')->get();
    }

    public function render(): View | Closure | string
    {
        return view('components.site.layout.includes.mobile-menu');

    }//end of render

}//end of class