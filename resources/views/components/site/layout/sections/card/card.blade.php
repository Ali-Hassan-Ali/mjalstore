<div class="col-md-3">
    <a href="{{ $subCategory->has_market ? route('site.show.market.card', ['sub_category' => $subCategory->slug, 'market' => $card?->market?->slug, 'card' => $card->slug]) : route('site.show.card', ['sub_category' => $subCategory->slug, 'card' => $card->slug]) }}">
        <div class="box-card" style="background: linear-gradient(180deg, {{ $subCategory->color_1 }} 0%, {{ $subCategory->color_2 }} 100%)">
            <div class="title-card">
                <h2 class="text-light">{{ $subCategory->name }}</h2>
                <p class="text-light">{{ $subCategory->title_card }}</p>
                @if($card?->market?->count())
                    <span class="text-light">{{ $card?->market?->name }}</span>
                @endif
                <strong class="text-light">{{ $card->new_price }}</strong>
            </div>
            <ul class="option-card">
                <li><a><img src="{{ asset('site_assets/images/surface.svg') }}" /><span>اشتري الان</span></a></li>
                <li><a><img src="{{ asset('site_assets/images/shopping-cart.svg') }}" /><span>أضف للسلة</span></a></li>
            </ul>
        </div>
    </a>
</div>