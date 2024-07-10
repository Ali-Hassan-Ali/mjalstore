<div class="col-md-3">
    <a href="{{ route('site.products.market', ['sub_category' => $subCategory->slug, 'market' => $market->slug]) }}">
        <div class="box-card pb-5" style="background: linear-gradient(180deg, {{ $subCategory->color_1 }} 0%, {{ $subCategory->color_2 }} 100%)">
            <div class="title-card">
                <h2>{{ $subCategory->name }}</h2>
                <p>{{ $subCategory->title_card }}</p>
                <h6>
                    <img src="{{ $market->image_path }}" style="border-radius: 50%;" width="70">
                </h6>
                <span>{{ $market->name }}</span>
            </div>
        </div>
    </a>
</div>