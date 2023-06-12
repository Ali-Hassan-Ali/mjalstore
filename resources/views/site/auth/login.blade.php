<x-site.layout.app>

<x-slot name="title">{{ trans('auth.login') }}</x-slot>

    <div class="container">
    	
	    <div class="form-reg">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade container show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                    <x-site.layout.sections.auth.login/>
                </div>
            </div>
        </div>
	    
    </div>{{-- container --}}
    <!--section_profile-->

</x-site.layout.app>