<x-site.layout.app>

<x-slot name="title">{{ trans('site.global.fast_purchase') }}</x-slot>

    
    <x-site.layout.includes.breadcrumb :breadcrumb="$breadcrumb"/>
    <!--breadcrumb-->

    <section class="section_ticit_supp">
        <div class="container">
            <div class="content-purchase">
                
                <x-site.layout.sections.index.fast-purchase.navbar/>
    			<!--navbar-->

                <div class="flex-puch">

                    <x-site.layout.sections.index.fast-purchase.card/>
    				<!--card-->

    				<x-site.layout.sections.index.fast-purchase.data-puch/>
    				<!--data-puch-->

                </div>
            </div>
        </div>
    </section> 

    <x-slot name="scripts">
    	<x-site.layout.sections.index.fast-purchase.script/>
    </x-slot>

</x-site.layout.app>