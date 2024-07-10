@if($type == 'card')

    @if(request()->is('*cart/search*'))

        <div class="{{ $col }}">
            <a href="{{ route('site.products.show.card', ['sub_category' => $card?->subCategory->slug, 'card' => $card->slug]) }}">
                <div class="box-card" style="background: linear-gradient(180deg, {{ $card?->subCategory?->color_1 }} 0%, {{ $card?->subCategory?->color_2 }} 100%)">
                    <div class="title-card">
                        <h2 class="text-light">{{ $card?->subCategory->name }}</h2>
                        <p class="text-light">{{ $card?->subCategory->title_card }}</p>
                        @if($card?->market?->count())
                            <span class="text-light">{{ $card?->market?->name }}</span>
                        @else
                            <span class="text-light">😊✌</span>
                        @endif
                        <strong class="text-light">{{ $card->new_price }}</strong>
                    </div>
                    <ul class="option-card">
                        <x-site.layout.sections.products.cart.button :card="$card"/>
                    </ul>
                </div>
            </a>
        </div>

    @else

        <div class="{{ $col }}">
            <a href="{{ $subCategory?->has_market ? route('site.products.show.market.card', ['sub_category' => $subCategory->slug, 'market' => $card?->market?->slug, 'card' => $card->slug]) : route('site.products.show.card', ['sub_category' => $subCategory->slug, 'card' => $card->slug]) }}">
                <div class="box-card" style="background: linear-gradient(180deg, {{ $subCategory->color_1 }} 0%, {{ $subCategory->color_2 }} 100%)">
                    <div class="title-card">
                        <h2 class="text-light">{{ $subCategory->name }}</h2>
                        <p class="text-light">{{ $subCategory->title_card }}</p>
                        @if($card?->market?->count())
                            <span class="text-light">{{ $card?->market?->name }}</span>
                        @else
                            <span class="text-light">😊✌</span>
                        @endif
                        <strong class="text-light">{{ $card->new_price }}</strong>
                    </div>
                    <ul class="option-card">
                        <x-site.layout.sections.products.cart.button :card="$card"/>
                    </ul>
                </div>
            </a>
        </div>

    @endif

@else

<div class="{{ $col }}">
    <a href="{{ route('site.products.show.card', ['sub_category' => $card->subCategory->slug, 'card' => $card->slug]) }}">
        <div class="box-card" style="background: linear-gradient(180deg, {{ $card->subCategory->color_1 }} 0%, {{ $card->subCategory->color_2 }} 100%)">
            <div class="title-card">
                <h2 class="text-light">{{ $card->subCategory->name }}</h2>
                <p class="text-light">{{ $card->subCategory->title_card }}</p>
                @if($card?->market?->count())
                    <span class="text-light">{{ $card?->market?->name }}</span>
                @else
                    <span class="text-light">😊✌</span>
                @endif
                <strong class="text-light">{{ $card->new_price }}</strong>
            </div>
            <ul class="option-card">
                <x-site.layout.sections.products.cart.button :card="$card"/>
            </ul>
        </div>
    </a>
</div>

@endif