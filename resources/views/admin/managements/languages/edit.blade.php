<x-admin.layout.app>
    <x-slot name="title">
        {{ trans('site.edit') . ' ' . trans('menu.languages') }}
    </x-slot>

    <div>
        <h2>@lang('menu.languages')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.index') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.managements.languages.index') }}">@lang('menu.languages')</a></li>
        <li class="breadcrumb-item">@lang('site.edit')</li>
    </ul>

    <form method="post" action="{{ route('admin.managements.languages.update', $language->id) }}" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="row">

            <div class="col-12 col-md-4">

                <div class="tile shadow">

                    @include('admin.dataTables.image_privew', ['name' => 'flag', 'imagepath' => $language->image_path, 'label' => 'flag'])

                </div><!-- end of tile -->

            </div><!-- end of col -->

            <div class="col-12 col-md-8">

                <div class="tile shadow row">

					{{--name--}}
                    <x-input.text required="true" name="name" label="site.name" col="col-md-6" :value="$language->name"/>

                    {{--code--}}
                    <x-input.text required="true" name="code" label="site.code" col="col-md-6" :value="$language->code"/>

                    {{--type--}}
                    <x-input.option required="true" name="dir" label="site.dir" :lists="$types" :value="$language->dir"/>

                    {{--status--}}
                    <x-input.checkbox :required="true" name="status" label="admin.global.status" :value="$language->status"/>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.edit')</button>
                    </div>

                </div><!-- end of tile -->

            </div><!-- end of col -->

        </div><!-- end of row -->

    </form><!-- end of form -->

</x-admin.layout.app>
