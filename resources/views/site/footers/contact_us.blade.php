<x-site.layout.app>

<x-slot name="title">{{ trans('settings.contact') }}</x-slot>

    <x-site.layout.includes.breadcrumb :breadcrumb="$breadcrumb"/>
    <!--breadcrumb-->

    <x-site.layout.sections.footer.contact/>
    <!--contact-->

    <x-slot name="scripts">
    	<x-site.layout.sections.footer.script/>
    </x-slot>

</x-site.layout.app>