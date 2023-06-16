<li>
    <a href="{{ route('site.products.cart.add', $card->id) }}" class="purchase-now">
        <img src="{{ asset('site_assets/images/surface.svg') }}" />
        <span>{{ trans('site.products.carts.purchase_now') }}</span>
    </a>
</li>
<li>
    <a class="add-to-cart" data-id="{{ $card->id }}">
        <img src="{{ asset('site_assets/images/shopping-cart.svg') }}" />
        <span>{{ trans('site.products.carts.add_to_cart') }}</span>
    </a>
</li>