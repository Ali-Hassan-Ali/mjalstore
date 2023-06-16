<x-site.layout.app>

<x-slot name="title">{{ trans('menu.sub_categories') }}</x-slot>

    <x-site.layout.sections.products.card.banner :image="$subCategory->image_path"/>
    <!--banner_page-->

    <x-site.layout.includes.breadcrumb :breadcrumb="$breadcrumb"/>
    <!--breadcrumb-->

    <div class="container"> 

        <div class="row">
            @if($subCategory->has_market)

                @foreach($subCategory->markets as $market)
                    <x-site.layout.sections.products.card.market :sub-category="$subCategory" :market="$market"/>
                    <!--market-->
                @endforeach

            @else

                @foreach($subCategory->cards as $card)
                    <x-site.layout.sections.products.card.card :sub-category="$subCategory" :card="$card"/>
                    <!--card-->
                @endforeach

            @endif
        </div>{{-- row --}}

    </div>{{-- container --}}

</x-site.layout.app>