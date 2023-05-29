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

                        @php($items = ['phone', 'email', 'address', 'address_link'])

                        @foreach($items as $item)

                            {{--$item--}}
                            <x-input.text required="true" :name="'contact_' . $item" :label="'site.' . $item" :value="getSetting('contact_' . $item)" col="col-md-6"/>

                        @endforeach

                	</div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.create')</button>
                    </div>

                </div><!-- end of tile -->

            </div><!-- end of col -->

        </div><!-- end of row -->

    </form><!-- end of form -->

</x-admin.layout.app>