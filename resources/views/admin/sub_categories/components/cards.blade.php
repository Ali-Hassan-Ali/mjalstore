<div class="box-card" style="background: linear-gradient(180deg, {{ old('color_1', $color1) }} 0%, {{ old('color_2', $color2) }} 100%)">
    <div class="title-card">
        <h2 id="sub_category-card">{{ $subCategory }}</h2>
        <p id="title-card">{{ $title }}</p>
        @if($market)
            <span id="market-card">{{ $market }}</span>
        @endif
        <strong id="price-card">{{ $price }} $</strong>
    </div>
    <ul class="option-card">
        <li><a><img src="{{ asset('admin_assets/images/cards/surface.svg') }}" />  <span class="text-dark">اشتري الان</span></a></li>
        <li><a><img src="{{ asset('admin_assets/images/cards/shopping-cart.svg') }}" /><span class="text-dark">أضف للسلة</span></a></li>
    </ul>
</div>