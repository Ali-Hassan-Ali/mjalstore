<li class="iconfinder">
    <a href="referral-system.html">
    <img src="{{ asset('site_assets/images/iconfinder_Referrals.svg') }}" alt=""/></a>
</li>

<li class="cart-purches-btn dropdown dropdown-cart-shooping">
    <a class="show-cart">
        <div class="title-basket">
            <p>{{ trans('site.products.carts.cat_me') }}</p>
            <small class="cart-total">{{ \App\Helpers\Cart::subtotal() }}</small>
        </div>
        <figure><img src="{{ asset('site_assets/images/icon-shopping.svg') }}" /><span id="cart-menu-count">{{ \App\Helpers\Cart::count() }}</span></figure>
    </a>
    <ul class="dropdown-menu">
        <a class="remove-drop"><i class="zmdi zmdi-close"></i></a>
        <div id="cart-menu-item">
            @foreach(\App\Helpers\Cart::all() as $cart)
                <li id="cart-{{ $cart['uuid'] }}">
                    <div class="image-product" style="background: linear-gradient(180deg, {{ $cart['color_1'] }} 0%, {{ $cart['color_2'] }} 100%)">
                        <p class="text-light mt-3">{{ $cart['sub_category'] }}</p>
                        <a class="remove-product" data-uuid="{{ $cart['uuid'] }}"><i class="fa fa-trash"></i></a>
                    </div>
                    <div class="title-cart">
                        <p><a href="#">{{ $cart['title_card'] }}</a></p>
                        <div class="price-counter">
                            <strong id="total-price-{{ $cart['uuid'] }}">{{ $cart['total_price'] }}</strong>
                            <div class="quantity-item">
                                <div class="quantity">
                                    <input type="text" name="count-quat1" class="count-quat" value="{{ $cart['quantity'] }}" id="quantity-{{ $cart['uuid'] }}">
                                    <div class="btn button-count inc change-quantity jsQuantityIncrease" data-uuid="{{ $cart['uuid'] }}"><i class="fa fa-plus" aria-hidden="true"></i></div>
                                    <div class="btn button-count dec change-quantity jsQuantityDecrease disabled" minimum="1" data-uuid="{{ $cart['uuid'] }}"><i class="fa fa-minus" aria-hidden="true"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </div>
        <div class="total-price">
            <p>{{ trans('site.products.carts.total') }}</p>
            <strong class="cart-total">{{ \App\Helpers\Cart::subtotal() }}</strong>
        </div>
        <div class="option-cart">
            <a href="cart.html" class="btn-site-bg"><small>{{ trans('site.products.carts.cart_detile') }}</small></a>
            <a href="checkout.html" class="btn-site outline"><small>{{ trans('site.products.carts.purchase_now') }}</small></a>
        </div>
    </ul>
</li>