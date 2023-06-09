<x-admin.layout.app>
    <x-slot name="title">
        {{ trans('site.edit') . ' ' . trans('menu.markets') }}
    </x-slot>

    <div>
        <h2>@lang('menu.markets')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.index') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('menu.products')</li>
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.products.markets.index') }}">@lang('menu.markets')</a></li>
        <li class="breadcrumb-item">@lang('site.edit')</li>
    </ul>

    <form method="post" action="{{ route('admin.products.markets.update', $market->id) }}" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="row">

            <div class="col-12 col-md-4">

                <div class="tile shadow">

                    @include('admin.dataTables.image_privew', ['name' => 'flag', 'imagepath' => $market->image_path, 'label' => 'flag'])

                </div><!-- end of tile -->

            </div><!-- end of col -->

            <div class="col-12 col-md-8">

                <div class="tile shadow">

                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                        @foreach(getLanguages() as $language)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="{{ $language->code }}-tab" data-toggle="tab" data-target="#{{ $language->code }}" type="button" role="tab" aria-controls="{{ $language->code }}" aria-selected="{{ $loop->first ? true : false }}">
                                    {{ $language?->name }}
                                </button>
                            </li>
                        @endforeach

                    </ul>

                    <div class="tab-content" id="myTabContent">
                        @foreach(getLanguages() as $language)
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $language->code }}" role="tabpanel" aria-labelledby="{{ $language->code }}-tab">

                                {{--name--}}
                                <x-input.text required="{{ $loop->first ? true : false }}" 
                                    name="name[{{ $language->code }}]" 
                                    label="site.name" :value="$market->getTranslations('name')[$language->code] ?? ''"
                                    invalid="{{ 'name.' . $language->code }}" />

                            </div>
                        @endforeach
                    </div>

                </div><!-- end of tile -->

                <div class="tile shadow">

                    {{--categories--}}
                    <x-input.option required="true" name="sub_categories[]" label="site.sub_categories" :lists="$subCategories" multiple="true" :value="old('sub_categories', $market->subCategories->pluck('id')->toArray())"/>

                    {{--status--}}
                    <x-input.checkbox :required="true" name="status" label="admin.global.status" col="col-md" :value="$market->status"/>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.edit')</button>
                    </div>

                </div><!-- end of tile -->

            </div><!-- end of col -->

        </div><!-- end of row -->

    </form><!-- end of form -->

</x-admin.layout.app>