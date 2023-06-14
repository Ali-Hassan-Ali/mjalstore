<x-admin.layout.app>
    <x-slot name="title">
        {{ trans('admin.global.edit') . ' ' . trans('menu.category') }}
    </x-slot>

    <div>
        <h2>@lang('menu.categories')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.index') }}">@lang('admin.global.home')</a></li>
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.categories.index') }}">@lang('menu.categories')</a></li>
        <li class="breadcrumb-item">@lang('admin.global.edit')</li>
    </ul>

    <form method="post" action="{{ route('admin.categories.update', $category->id) }}" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="row">

            <div class="col-12 col-md-4">

                <div class="tile shadow">

                    @include('admin.dataTables.image_privew', ['name' => 'logo', 'imagepath' => $category->image_path, 'admin.global.label' => 'logo'])

                </div><!-- end of tile -->

            </div><!-- end of col -->

            <div class="col-12 col-md-8">

                <div class="tile shadow">

                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                        @foreach(getLanguages() as $language)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="{{ $language->code }}-tab" data-toggle="tab" data-target="#{{ $language->code }}" type="button" role="tab" aria-controls="{{ $language->code }}" aria-selected="{{ $loop->first }}">
                                    {{ $language?->name }}
                                </button>
                            </li>
                        @endforeach

                    </ul>

                    <div class="tab-content" id="myTabContent">
                        @foreach(getLanguages() as $language)
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $language->code }}" role="tabpanel" aria-labelledby="{{ $language->code }}-tab">
                                {{--name--}}

                                <x-input.text required="{{ $loop->first }}" 
                                    name="name[{{ $language->code }}]" 
                                    label="admin.global.name"
                                    value="{{ $category->getTranslations('name')[$language->code] ?? '' }}"
                                    invalid="{{ 'name.' . $language->code }}" />

                            </div>
                        @endforeach
                    </div>

                    {{--status--}}
                    <x-input.checkbox :required="true" name="status" label="admin.global.status" value="{{ $category->status }}"/>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('admin.globa.edit')</button>
                    </div>

                </div><!-- end of tile -->

            </div><!-- end of col -->

        </div><!-- end of row -->

    </form><!-- end of form -->

</x-admin.layout.app>