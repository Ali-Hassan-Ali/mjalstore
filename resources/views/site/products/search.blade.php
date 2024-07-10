<x-site.layout.app>

<x-slot name="title">{{ trans('site.products.carts.search_card') }}</x-slot>

    <x-site.layout.includes.breadcrumb :breadcrumb="$breadcrumb"/>
    <!--breadcrumb-->

    <div class="container"> 

        <div class="row">

            @foreach($cards as $card)
				<x-site.layout.sections.products.card.card :sub-category="[]" :card="$card"/>
				<!--card-->
			@endforeach  

        </div>{{-- row --}}

    </div>{{-- container --}}

</x-site.layout.app>