<x-site.layout.app>

<x-slot name="title">{{ $page->title }}</x-slot>

    <x-site.layout.includes.breadcrumb :breadcrumb="$breadcrumb"/>
    <!--breadcrumb-->

    <x-site.layout.sections.footer.page :page="$page"/>
    <!--section_st_page-->

</x-site.layout.app>