<div class="col-md-3">
    <a href="{{ route('site.market', ['sub_category' => $subCategory->slug, 'market' => $market->slug]) }}">
        <div class="box-card" style="background: linear-gradient(180deg, {{ $subCategory->color_1 }} 0%, {{ $subCategory->color_2 }} 100%)">
            <div class="title-card">
                <h2>{{ $subCategory->name }}</h2>
                <p>{{ $subCategory->title_card }}</p>
                <span>{{ $market->name }}</span>
            </div>
        </div>
    </a>
</div>