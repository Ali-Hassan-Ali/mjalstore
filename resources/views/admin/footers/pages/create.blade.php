<x-admin.layout.app>
    <x-slot name="title">
        {{ trans('site.create') . ' ' . trans('menu.pages') }}
    </x-slot>

    <div>
        <h2>@lang('menu.pages')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.index') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('menu.footers')</li>
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.footers.pages.index') }}">@lang('menu.pages')</a></li>
        <li class="breadcrumb-item">@lang('site.create')</li>
    </ul>

    <form method="post" action="{{ route('admin.footers.pages.store') }}" enctype="multipart/form-data">
        @csrf
        @method('post')

        <div class="row">

            <div class="col-12 col-md-12">

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
                                
                                {{--title--}}
                                <x-input.text required="{{ $loop->first ? true : false }}" 
                                    name="title[{{ $language->code }}]" 
                                    label="site.title"
                                    invalid="{{ 'title.' . $language->code }}" />

								{{-- description_one --}}
                                <x-input.textarea required="{{ $loop->first ? true : false }}" 
	                                    name="description_one[{{ $language->code }}]" 
	                                    label="site.description_one" :ckeditor='true' :value="old('description_one.' . $language->code)"
	                                    invalid="{{ 'description_one.' . $language->code }}" />

								{{-- description_tow --}}
                                <x-input.textarea required="{{ $loop->first ? true : false }}" 
	                                    name="description_tow[{{ $language->code }}]" 
	                                    label="site.description_tow" :ckeditor='true' :value="old('description_tow.' . $language->code)"
	                                    invalid="{{ 'description_tow.' . $language->code }}" />

                            </div>
                        @endforeach
                    </div>

                </div><!-- end of tile -->

            </div><!-- end of col -->

            <div class="col-12 col-md-12">

                <div class="tile shadow">

                	<div class="row">

	                    {{--status--}}
	                    <x-input.checkbox :required="true" name="status" label="admin.global.status" col="col-md"/>

	                    {{--order--}}
	                    <x-input.text type="number" :required="true" name="order" label="admin.global.order" col="col-md"/>
                		
                	</div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.create')</button>
                    </div>

                </div><!-- end of tile -->

            </div><!-- end of col -->

        </div><!-- end of row -->

    </form><!-- end of form -->

</x-admin.layout.app>
