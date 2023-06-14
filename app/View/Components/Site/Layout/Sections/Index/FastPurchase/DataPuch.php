<?php

namespace App\View\Components\Site\Layout\Sections\Index\FastPurchase;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Category;

class DataPuch extends Component
{
    public function __construct(
        public $categories = [],
        public $subCategories = [],
    ){
        $this->categories    = Category::category()->pluck('name', 'id');
        $this->subCategories = collect(Category::subCategory()->get())->groupBy('parent_id');
    }

    public function render(): View | Closure | string
    {
        return view('components.site.layout.sections.index.fast-purchase.data-puch');

    }//end of render

}//end of c;class