@if($count)

    <section class="section_ticit_supp">
        <div class="container">
            <div class="sec_head text-center">
                <h2>{{ trans('site.products.carts.shoping_cart') }}</h2>
            </div>
            <div class="content-ticit">
                <table class="table-site tabel-cart">
                <tr>
                    <th>{{ trans('menu.product') }}</th>
                    <th>{{ trans('site.products.carts.quantity') }}</th>
                    <th>{{ trans('admin.global.price') }}</th>
                    <th>{{ trans('admin.global.delete') }}</th>
                </tr>
                @foreach($carts as $cart)
                <tr class="remove-cart-{{ $cart['uuid'] }}">
                    <td>
                        <div class="boc-pr">
                            <figure class="image-product" style="background: linear-gradient(180deg, {{ $cart['color_1'] }} 0%, {{ $cart['color_2'] }} 100%)"></figure>
                            <div class="sec-title">
                                <p>{{ $cart['sub_category'] }}</p>
                                <span>{{ $cart['title_card'] }}</span>
                                <div class="data-mobail">
                                    <div class="quantity-item">
                                        <div class="quantity">
                                            <input type="text" name="count-quat1" class="count-quat quantity-{{ $cart['uuid'] }}" id="quantity-page-{{ $cart['uuid'] }}" value="{{ $cart['quantity'] }}">
                                            <div class="btn button-count inc jsQuantityIncrease" data-uuid="{{ $cart['uuid'] }}" data-type="page"><i class="fa fa-plus" aria-hidden="true"></i></div>
                                            <div class="btn button-count dec jsQuantityDecrease disabled" minimum="1" data-uuid="{{ $cart['uuid'] }}" data-type="page"><i class="fa fa-minus" aria-hidden="true"></i></div>
                                        </div>
                                    </div>
                                    <p class="total-price-{{ $cart['uuid'] }}">{{ getNewPrice($cart['total_price']) }}</p>
                                    <a class="remove-pr" data-uuid="{{ $cart['uuid'] }}"><i class="fa fa-trash"></i></a>
                                </div>
                            </div>
                        </div>  
                    </td>
                    <td>
                        <div class="quantity-item">
                            <div class="quantity">
                                <input type="text" name="count-quat1" class="count-quat quantity-{{ $cart['uuid'] }}" id="quantity-mobile-{{ $cart['uuid'] }}" value="{{ $cart['quantity'] }}">
                                <div class="btn button-count inc jsQuantityIncrease" data-uuid="{{ $cart['uuid'] }}" data-type="mobile"><i class="fa fa-plus" aria-hidden="true"></i></div>
                                <div class="btn button-count dec jsQuantityDecrease disabled" minimum="1" data-uuid="{{ $cart['uuid'] }}" data-type="mobile"><i class="fa fa-minus" aria-hidden="true"></i></div>
                            </div>
                        </div>
                    </td>
                    <td class="total-price-{{ $cart['uuid'] }}">{{ getNewPrice($cart['total_price']) }}</td>
                    <td><a class="remove-pr" data-uuid="{{ $cart['uuid'] }}"><i class="fa fa-trash"></i></a></td>
                </tr>
                @endforeach
                <tr>
                    <td>
                        <div class="option-table-cart">
                            <div class="total-cart">
                                <p>{{ trans('site.products.carts.total') }}:</p>
                                <strong class="cart-total">{{ $total }}</strong>
                            </div>
                            <ul>
                            @if(!session()->has('cupon_code'))
                                <li><span>{{ trans('site.products.carts.cupon_code') }}</span>
                                    <form id="cupon-cart">
                                        <input type="text" id="cupon-cart-input" class="form-control" placeholder="{{ trans('site.products.carts.cupon') }}"/>
                                    </form>
                                </li>
                                <li>
                                    <a class="btn-site btn-shop" href="{{ route('site.fast_purchase.index') }}">
                                        <span>{{ trans('site.products.carts.purchase_now') }}</span>
                                    </a>
                                </li>
                            @else

                                <li>
                                    <form id="cupon-delete-cart" style="display: flex;">
                                        <button class="btn">
                                            <h4><i class="fa fa-trash text-danger"></i></h4>
                                        </button>
                                        <input type="text" id="cupon-cart-input" class="form-control" value="{{ session()->get('cupon_code') }}" placeholder="{{ session()->get('cupon_code') . ' ' . session()->get('cupon_price') }}" disabled readonly/>
                                    </form>
                                </li>
                                <li>
                                    <a class="btn-site btn-shop" href="{{ route('site.fast_purchase.index') }}">
                                        <span>{{ trans('site.products.carts.purchase_now') }}</span>
                                    </a>
                                </li>

                            @endif
                            </ul>
                        </div>
                    </td>
                </tr>
                </table>
            </div>

            @if(auth('web')->check() && !auth('web')->user()->checkActivePhone())


                <div class="not-mobail">
                    <div class="sec-title">
                        <img src="{{ assert('site_assets/images/005-warning.svg') }}" alt="" />
                        <h2>{{ trans('auth.phone_not_active') }}</h2>
                    </div>
                    <figure><img src="{{ asset('site_assets/images/not-mobail.png') }}" alt="" /></figure>
                </div>

            @else
            
                <div class="col-md-4 col-sm-4 mx-auto my-4">
                    <div class="clearfix">
                        <ul class="menu-purches clearfix">
                            <li class="login-btn">
                                <img src="{{ asset('site_assets/images/icon-user.svg') }}" alt="{{ getTransSetting('websit_title', app()->getLocale()) }}" />
                                <a class="model-auth" data-type="login" data-toggle="modal" data-target="#exampleModal">{{ trans('auth.sign_in') }}</a>
                                <a class="model-auth" data-type="register" data-toggle="modal" data-target="#exampleModal">{{ trans('auth.create_acount') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>

            @endif
            
        </div>
    </section>

@else

    <h2 class="text-center">{{ trans('admin.global.no_data_found') }}</h2>

@endif