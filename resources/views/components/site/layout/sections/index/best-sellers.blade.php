<section class="section_best_sellers">
    <div class="container">
        <div class="sec_head">
            <h3>البطاقات الأكثر مبيعاً</h3>
            <p>أفضل البطاقات مبيعاً وضمان من مجال ستور</p>
        </div>
        <div class="owl-carousel" id="card-sellers-slider">

            @foreach($cards as $card)
                <div class="item">
                    <x-site.layout.sections.products.card.card type="items" :card="$card"/>
                    <!--card-->
                </div>
            @endforeach

        </div>
    </div>
</section>