<x-site.layout.app>

<x-slot name="title">{{ trans('settings.about_page') }}</x-slot>

    <x-site.layout.includes.breadcrumb :breadcrumb="$breadcrumb"/>
    <!--breadcrumb-->

    <x-site.layout.sections.footer.about/>
    <!--about-->

    <x-site.layout.sections.index.what-site/>
    <!--section_what_site-->

    <x-site.layout.sections.index.subscriber-ratings/>
    <!--section_subscriber_ratings-->

    <x-site.layout.sections.index.download-app/>

</x-site.layout.app>