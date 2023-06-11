<x-site.layout.app>

<x-slot name="title">{{ trans('menu.sub_categories') . ' - ' . trans('menu.markets') }}</x-slot>

    <x-site.layout.includes.breadcrumb :breadcrumb="$breadcrumb"/>
    <!--breadcrumb-->

	<x-site.layout.sections.card.details :sub-category="$subCategory" :card="$card"/>
    <!--card details-->

    <section class="section_all_products">
        <div class="container">
            <div class="sec_head text-center">
                <h3> بطاقات نقترحها اليك</h3>
                <p>أفضل البطاق ات مبيعاً وضمان من مجال ستور</p>
            </div>
            <div class="row">
				@foreach($cards as $card)
					<x-site.layout.sections.card.card :sub-category="$subCategory" :card="$card"/>
					<!--card-->
				@endforeach  
            </div>
        </div>
    </section>
    <!--section_best_sellers-->

</x-site.layout.app>