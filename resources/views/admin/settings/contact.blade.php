<x-admin.layout.app>
    <x-slot name="title">
        {{ trans('settings.settings') . ' ' . trans('settings.contact') }}
    </x-slot>

    <div>
        <h2>@lang('settings.contact')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.index') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('settings.contact')</li>
    </ul>

    <form method="post" action="{{ route('admin.settings.contact.store') }}" enctype="multipart/form-data">
        @csrf
        @method('post')

        <div class="row">

            <div class="col-12 col-md-12">

                <div class="tile shadow">

                	<div class="row">
                		
	                	{{--phone--}}
	                    <x-input.text required="true" name="contact_phone" label="site.phone" :value="getSetting('contact_phone')" col="col-md-6"/>

	                    {{--email--}}
	                    <x-input.text required="true" name="contact_email" label="site.email" :value="getSetting('contact_email')" col="col-md-6" type="email"/>

	                    {{--address--}}
	                    <x-input.text required="true" name="contact_address" label="site.address" :value="getSetting('contact_address')" col="col-md-6"/>

	                    {{--address link--}}
	                    <x-input.text required="true" name="contact_address_link" label="site.address_link" :value="getSetting('contact_address_link')" col="col-md-6"/>

                	</div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.create')</button>
                    </div>

                </div><!-- end of tile -->

            </div><!-- end of col -->

        </div><!-- end of row -->

    </form><!-- end of form -->

</x-admin.layout.app>