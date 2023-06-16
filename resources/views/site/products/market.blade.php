<x-site.layout.app>

<x-slot name="title">{{ trans('menu.sub_categories') . ' - ' . trans('menu.markets') }}</x-slot>

    <x-site.layout.sections.products.card.banner :image="$subCategory->image_path"/>
    <!--banner_page-->

    <x-site.layout.includes.breadcrumb :breadcrumb="$breadcrumb"/>
    <!--breadcrumb-->

    <div class="container"> 

        <div class="row">
            @foreach($market->cards as $card)
                <x-site.layout.sections.products.card.card :subCategory="$subCategory" :card="$card"/>
                <!--market-->
            @endforeach
        </div>{{-- row --}}

    </div>{{-- container --}}

</x-site.layout.app>