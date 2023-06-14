<?php

namespace App\View\Components\Site\Layout\Sections\Index\FastPurchase;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Category;
use App\Models\Card;

class Script extends Component
{
    public function __construct(
        public $categories = [],
        public $subCategories = [],
        public $subCategoriesGroupBy = [],
        public $cards = [],
        public $cardsCategory = [],
    ){
        $this->categories    = Category::category()->pluck('name', 'id');
        $this->subCategories = collect(Category::subCategory()->with('markets')->get())->groupBy('id');
        $this->subCategoriesGroupBy = collect(Category::subCategory()->get())->groupBy('parent_id');
        $this->cards = collect(Card::all())->groupBy('market_id');
        $this->cardsCategory = collect(Card::all())->groupBy('category_id');
    }

    public function render(): View | Closure | string
    { 
        return view('components.site.layout.sections.index.fast-purchase.script');

    }//end of render

}//end of class