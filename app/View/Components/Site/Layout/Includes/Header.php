<?php

namespace App\View\Components\Site\Layout\Includes;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Language;
use App\Models\Currency;
use App\Models\Category;

class Header extends Component
{
    public function __construct(
        public $languages  = [],
        public $currencies = [],
        public $categories = [],
    ){
        $this->languages  = Language::pluck('name', 'code');
        $this->currencies = Currency::pluck('name', 'code');
        $this->categories = Category::category()->with('subCategoriesRelation')->get();
    }

    public function render(): View | Closure | string
    {
        return view('components.site.layout.includes.header');

    }//end of render

}//end of class