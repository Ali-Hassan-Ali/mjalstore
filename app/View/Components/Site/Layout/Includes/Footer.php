<?php

namespace App\View\Components\Site\Layout\Includes;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Page;
use App\Models\PaymentMethod;

class Footer extends Component
{
    public function __construct(
       public $pages = [],
       public $paymentMethods = [],
    ){
        $this->pages = Page::orderBy('order')->pluck('title', 'slug');
        $this->paymentMethods = PaymentMethod::orderBy('order')->pluck('image');
    }

    public function render(): View | Closure | string
    {
        return view('components.site.layout.includes.footer');

    }//end of render 

}//end of class