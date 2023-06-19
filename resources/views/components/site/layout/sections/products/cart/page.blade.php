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
                      <div class="total-cart"><p>{{ trans('site.products.carts.total') }}:</p><strong class="cart-total">{{ $total }}</strong></div>
                          <ul>
                              <li><span>كوبون الخصم</span><form><input type="text" class="form-control" placeholder="..." /></form></li>
                              <li><a class="btn-site btn-shop"><span>{{ trans('site.products.carts.purchase_now') }}</span></a></li>
                          </ul>
                     </div>
                 </td>
              </tr>
                </table>
            </div>

            @if(auth('web')->check())

                <div class="not-mobail">
                    <div class="sec-title">
                        <img src="images/005-warning.svg" alt="" />
                        <h2>يحتاج رقم الجوال الى تفعيل!</h2>
                    </div>
                    <figure><img src="images/not-mobail.png" alt="" /></figure>
                </div>

            @endif
            
        </div>
    </section>
@else

    <h2 class="text-center">{{ trans('admin.global.no_data_found') }}</h2>

@endif