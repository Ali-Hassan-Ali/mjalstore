<x-admin.layout.app>
    <x-slot name="title">
        {{ trans('site.create') . ' ' . trans('menu.sub_categories') }}
    </x-slot>

    <x-slot name="style">
        <link href="{{ asset('admin_assets/css/cards.css') }}" rel="stylesheet">
    </x-slot>

    <div>
        <h2>@lang('menu.sub_categories')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.index') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.sub_categories.index') }}">@lang('menu.sub_categories')</a></li>
        <li class="breadcrumb-item">@lang('site.create')</li>
    </ul>

    <form method="post" action="{{ route('admin.sub_categories.store') }}" enctype="multipart/form-data">
        @csrf
        @method('post')

        <div class="row">

            <div class="col-12 col-md-4">

                <div class="tile shadow">

                    @include('admin.dataTables.image_privew', ['name' => 'banner', 'label' => 'banner', 'required' => true])

                </div><!-- end of tile -->

            </div><!-- end of col -->

            <div class="col-12 col-md-4">

                <div class="tile shadow" style="padding: 15% 4%;">

                    @include('admin.sub_categories.components.cards', ['color1' => '#199afe', 'color2' => '#8f06fa', 
                            'subCategory' => old('name.' . getLanguages('default')->code, 'GOOGLE GM'), 
                            'title'       => old('title_card.' . getLanguages('default')->code, 'حمل ما تريد من ألعاب PC المدفوعة'),
                            'market'      => old('market' . getLanguages('default')->code, 'المتجر'),
                            'price'       => old('price', '0000')])

                </div><!-- end of tile -->

            </div><!-- end of col -->

            <div class="col-12 col-md-4">

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
                                    label="site.name"
                                    invalid="{{ 'name.' . $language->code }}" />

                                {{--title_card--}}
                                <x-input.text required="{{ $loop->first ? true : false }}" 
                                    name="title_card[{{ $language->code }}]" 
                                    label="site.title_card"
                                    invalid="{{ 'title_card.' . $language->code }}" />

                                {{--description--}}
                                <x-input.textarea required="{{ $loop->first ? true : false }}" 
                                    name="description[{{ $language->code }}]" 
                                    label="site.description" rows='6'
                                    invalid="{{ 'description.' . $language->code }}" />


                            </div>
                        @endforeach
                    </div>

                </div><!-- end of tile -->

            </div><!-- end of col -->

            <div class="col-12 col-md-12">

                <div class="tile shadow">

                    <div class="row">
                        {{-- color 1 --}}
                        <x-input.text :required="true" name="color_1" type="color" label="site.color_1" col="col-md"/>

                        {{-- color 2 --}}
                        <x-input.text :required="true" name="color_2" type="color" label="site.color_2" col="col-md"/>

                    </div>

                    {{--categories--}}
                    <x-input.option required="true" name="parent_id" label="site.categories" :lists="$categories"/>

                    <div class="row">
                        {{--status--}}
                        <x-input.checkbox :required="true" name="status" label="admin.global.status" col="col-md"/>

                        {{-- has_market --}}
                        <x-input.checkbox :required="true" name="has_market" label="admin.global.has_market" col="col-md"/>
                        
                    </div>    


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.create')</button>
                    </div>

                </div><!-- end of tile -->

            </div><!-- end of col -->

        </div><!-- end of row -->

    </form><!-- end of form -->

    <x-slot name="scripts">
        @include('admin.sub_categories.components.scripts')
    </x-slot>

</x-admin.layout.app>