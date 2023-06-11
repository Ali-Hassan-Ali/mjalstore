<x-site.layout.app>

<x-slot name="title">{{ trans('auth.profile') . ' (' . auth()->user()->username . ')'  }}</x-slot>

    
    <x-site.layout.includes.breadcrumb :breadcrumb="$breadcrumb"/>
    <!--breadcrumb-->

    <section class="section_profile">
        <div class="container">
            <div class="sec_head text-center">
                <h2>معلومات الحساب</h2>
            </div>
            <div class="content-profile">
                <form class="form-profile">

                    <x-site.layout.sections.auth.profile.main-data/>
                    <!--main data-->

                    <x-site.layout.sections.auth.profile.setting-data/>
                    <!--setting data-->

                </form>
            </div>
        </div>
    </section> 
    <!--section_profile-->

<x-slot name="scripts">
    <x-site.layout.sections.auth.profile.scripts/>
</x-slot>

</x-site.layout.app>