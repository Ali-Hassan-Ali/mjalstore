<x-admin.layout.app>
    <x-slot name="title">
        {{ trans('setting.setting') . ' ' . trans('setting.media') }}
    </x-slot>

    <div>
        <h2>@lang('setting.media')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.index') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('setting.media')</li>
    </ul>

    <form method="post" action="{{ route('admin.settings.media.store') }}" enctype="multipart/form-data">
        @csrf
        @method('post')

        <div class="row">

            <div class="col-12 col-md-12">

                <div class="tile shadow">

                	<div class="row">

                        @php($items = ['facebook', 'twitter', 'instagram', 'video_links'])

                        @foreach($items as $item)

    	                	{{--phone--}}
    	                    <x-input.text required="true" :name="'media_' . $item" :label="'site.' . $item" :value="getSetting('media_' . $item)" col="col-md-6"/>

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