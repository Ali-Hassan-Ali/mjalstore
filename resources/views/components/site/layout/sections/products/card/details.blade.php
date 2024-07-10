<section class="section_details_product">
    <div class="container">
        <div class="content-details">
            <div class="card-product">
                <div class="box-card" style="background: linear-gradient(180deg, {{ $subCategory->color_1 }} 0%, {{ $subCategory->color_2 }} 100%)">
                    <div class="title-card">
                        <h2>{{ $subCategory->name }}</h2>
                        <small>{{ $subCategory->title_card }}</small>
                        <p>أستمتع بشراء الإضافات من ملابس وأسلحة من المتجر</p>
                        <span>{{ $card->market?->name }}</span>
                        <strong>{{ $card->new_price }}</strong>
                    </div>
                </div>
            </div>
            <div class="title-product">
                <h2>{{ $subCategory->name }}</h2>
                <p>{!! $subCategory->description !!}</p>
                <div class="rate-line">
                    @foreach(App\Enums\Admin\RatingCard::array() as $key=>$star)
                        <span class="zmdi zmdi-star {{ $card->rating >= $key ? 'checked' : '' }}"></span>
                    @endforeach
                </div>
                <ul class="option-card">
                    <li>
                        <a class="btn-site btn-shop" href="{{ route('site.products.cart.add', $card->id) }}">
                            <img src="{{ asset('site_assets/images/shop-white.png') }}" />
                            <span>{{ trans('site.products.carts.purchase_now') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="btn-site add-to-cart" data-id="{{ $card->id }}">
                            <img src="{{ asset('site_assets/images/shopping-blue.png') }}" />
                            <span>{{ trans('site.products.carts.add_to_cart') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="img-product">
                <img src="images/produ.png" alt="" />
            </div>
        </div>
    </div>
</section>