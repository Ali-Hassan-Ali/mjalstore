<x-admin.layout.app>
    <x-slot name="title">
        {{ trans('site.edit') . ' ' . trans('menu.admins') }}
    </x-slot>

    <div>
        <h2>@lang('menu.admins')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.index') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.managements.admins.index') }}">@lang('menu.admins')</a></li>
        <li class="breadcrumb-item">@lang('site.edit')</li>
    </ul>

    <form method="post" action="{{ route('admin.managements.admins.update', $admin->id) }}" enctype="multipart/form-data">
        @csrf
        @method('put')

        @include('partials._errors')

        <div class="row">

            <div class="col-12 col-md-4">

                <div class="tile shadow">

                    @include('admin.dataTables.image_privew', ['name' => 'image', 'imagepath' => $admin->image_path])

                </div><!-- end of tile -->

            </div><!-- end of col -->

            <div class="col-12 col-md-8">

                <div class="tile shadow row">

					{{--name--}}
                    <x-input.text required="true" name="name" label="site.name" col="col-md-6" :value="$admin->name"/>

                    {{--email--}}
                    <x-input.text required="true" name="email" label="site.email" col="col-md-6" type="email" :value="$admin->email"/>

                    {{-- password --}}
                    <x-input.text required="true" name="password" label="site.password" col="col-md-6" type="password"/>

                    {{-- password_confirmation --}}
                    <x-input.text required="true" name="password_confirmation" label="site.password_confirmation" col="col-md-6" type="password"/>

                    {{--roles--}}
                    <x-input.option required="true" name="roles[]" invalid="roles" label="site.roles" :lists="$roles" :multiple="true" :value="$admin->roles->pluck('name')->toArray()"/>

                    {{--status--}}
                    <x-input.checkbox :required="true" name="status" label="admin.global.status" :value="$admin->status"/>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.edit')</button>
                    </div>

                </div><!-- end of tile -->

            </div><!-- end of col -->

        </div><!-- end of row -->

    </form><!-- end of form -->

</x-admin.layout.app>