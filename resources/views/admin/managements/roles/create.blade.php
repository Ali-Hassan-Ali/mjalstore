<x-admin.layout.app>
    <x-slot name="title">
        {{ trans('site.create') . ' ' . trans('menu.roles') }}
    </x-slot>

    <div>
        <h2>@lang('menu.roles')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.index') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.managements.roles.index') }}">@lang('menu.roles')</a></li>
        <li class="breadcrumb-item">@lang('site.create')</li>
    </ul>

    <form method="post" action="{{ route('admin.managements.roles.store') }}" enctype="multipart/form-data">
        @csrf
        @method('post')

        <div class="row">

            <div class="col-md-12">

                <div class="tile shadow">

                    <form method="post" action="{{ route('admin.managements.roles.store') }}">
                        @csrf
                        @method('post')

                        @include('partials._errors')

                        {{--name--}}
                        {{--name--}}
                        <x-input.text required="true" name="name" label="site.name"/>

                        <h5>@lang('roles.permissions') <span class="text-danger">*</span></h5>

                        @php
                            $models = ['home', 'admins', 'roles', 'languages', 'settings', 'categories', 'sub_categories'];
                        @endphp

                        <table class="table">
                            <thead>
                            <tr>
                                <th>@lang('roles.model')</th>
                                <th>@lang('roles.permissions')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($models as $model)
                                <tr>
                                    <td>@lang($model . '.' . $model)</td>
                                    <td>
                                        <div class="animated-checkbox mx-2" style="display:inline-block;">
                                            <label class="m-0">
                                                <input type="checkbox" value="" name="" class="all-roles">
                                                <span class="label-text">@lang('site.all')</span>
                                            </label>
                                        </div>

                                        @php
                                            //create_roles, read_roles, update_roles, delete_roles
                                            $permissionMaps = ['create','read','update','delete','status'];
                                        @endphp

                                        @if ($model == 'statistics')
                                            @php
                                                $permissionMaps = ['read'];
                                            @endphp
                                        @endif

                                        @foreach ($permissionMaps as $permissionMap)
                                            <div class="animated-checkbox mx-2" style="display:inline-block;">
                                                <label class="m-0">
                                                    <input type="checkbox" value="{{ $permissionMap . '-' . $model }}" name="permissions[]" class="role" {{ old('permissions.' . $loop->index) == $permissionMap . '-' . $model ? 'checked' : '' }}>
                                                    <span class="label-text">{{ $permissionMap . '-' . $model }}</span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table><!-- end of table -->

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.create')</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of tile -->

            </div><!-- end of col -->

        </div><!-- end of row -->

    </form><!-- end of form -->

</x-admin.layout.app>
