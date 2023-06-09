<x-admin.layout.app>
    <x-slot name="title">
        {{ trans('site.create') . ' ' . trans('menu.languages') }}
    </x-slot>

    <div>
        <h2>@lang('menu.languages')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.index') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.managements.languages.index') }}">@lang('menu.languages')</a></li>
        <li class="breadcrumb-item">@lang('site.create')</li>
    </ul>

    <form method="post" action="{{ route('admin.managements.languages.store') }}" enctype="multipart/form-data">
        @csrf
        @method('post')

        <div class="row">

            <div class="col-12 col-md-4">

                <div class="tile shadow">

                    @include('admin.dataTables.image_privew', ['name' => 'flag', 'label' => 'flag', 'required' => true])

                </div><!-- end of tile -->

            </div><!-- end of col -->

            <div class="col-12 col-md-8">

                <div class="tile shadow row">

					{{--name--}}
                    <x-input.text required="true" name="name" label="site.name" col="col-md-6"/>

                    {{--code--}}
                    <x-input.text required="true" name="code" label="site.code" col="col-md-6"/>

                    {{--type--}}
                    <x-input.option required="true" name="dir" label="site.dir" :lists="$types"/>

                    {{--status--}}
                    <x-input.checkbox :required="true" name="status" label="admin.global.status"/>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.create')</button>
                    </div>

                </div><!-- end of tile -->

            </div><!-- end of col -->

        </div><!-- end of row -->

    </form><!-- end of form -->

</x-admin.layout.app>
