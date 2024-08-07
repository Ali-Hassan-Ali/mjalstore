<x-admin.layout.app>
    <x-slot name="title">
        {{ trans('admin.global.edit') . ' ' . trans('menu.roles') }}
    </x-slot>

    <div>
        <h2>@lang('menu.roles')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.index') }}">@lang('admin.global.home')</a></li>
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.managements.roles.index') }}">@lang('menu.roles')</a></li>
        <li class="breadcrumb-item">@lang('admin.global.edit')</li>
    </ul>

    <form method="post" action="{{ route('admin.managements.roles.update', $role->id) }}" enctype="multipart/form-data">
        @csrf
        @method('put')

        @include('partials._errors')

        <div class="row">

            <div class="col-md-12">

                <div class="tile shadow">

                    {{--name--}}
                    <x-input.text required="true" name="name" label="admin.global.name" :value="$role->name"/>

                    <h5>@lang('menu.permissions') <span class="text-danger">*</span></h5>

                    @php
                        $models = ['admins', 'roles', 'languages', 'settings', 'categories', 'sub_categories'];
                    @endphp

                    <table class="table">
                        <thead>
                        <tr>
                            <th>@lang('roles.model')</th>
                            <th>@lang('menu.permissions')</th>
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
                                            <span class="label-text">@lang('admin.global.all')</span>
                                        </label>
                                    </div>

                                    @php
                                        //edit_roles, read_roles, update_roles, delete_roles
                                        $permissionMaps = ['create','read','update','delete','status'];
                                    @endphp

                                    @if ($model == 'statistics')
                                        @php
                                            $permissionMaps = ['read'];
                                        @endphp
                                    @endif

                                @if(old('permissions'))
                                    @foreach ($permissionMaps as $permissionMap)
                                        <div class="animated-checkbox mx-2" style="display:inline-block;">
                                            <label class="m-0">
                                                <input type="checkbox" value="{{ $permissionMap . '-' . $model }}" name="permissions[{{ $loop->index }}]" class="role" {{ old('permissions.' . $loop->index) == $permissionMap . '-' . $model ? 'checked' : '' }}>
                                                <span class="label-text">{{ $permissionMap . '-' . $model }}</span>
                                            </label>
                                        </div>
                                    @endforeach
                                @else
                                    @foreach ($permissionMaps as $permissionMap)
                                        <div class="animated-checkbox mx-2" style="display:inline-block;">
                                            <label class="m-0">
                                                <input type="checkbox" value="{{ $permissionMap . '-' . $model }}" name="permissions[{{ $loop->index }}]" class="role" {{ in_array($permissionMap . '-' . $model, $role->permissions->pluck('name')->toArray()) ? 'checked' : '' }}>
                                                <span class="label-text">{{ $permissionMap . '-' . $model }}</span>
                                            </label>
                                        </div>
                                    @endforeach
                                @endif
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table><!-- end of table -->

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('admin.global.edit')</button>
                    </div>

                </div><!-- end of tile -->

            </div><!-- end of col -->

        </div><!-- end of row -->

    </form><!-- end of form -->

</x-admin.layout.app>
