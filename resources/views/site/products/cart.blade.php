<x-site.layout.app>

<x-slot name="title">{{ trans('site.products.carts.cart') }}</x-slot>

    <x-site.layout.includes.breadcrumb :breadcrumb="$breadcrumb"/>
    <!--breadcrumb-->

    <x-site.layout.sections.products.cart.page/>
    <!--page-->

</x-site.layout.app>