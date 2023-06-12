<x-admin.layout.app>
    <x-slot name="title">
        {{ trans('settings.settings') . ' ' . trans('settings.faq') }}
    </x-slot>

    <div>
        <h2>@lang('settings.faq')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.index') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('settings.faq')</li>
    </ul>

    <form method="post" action="{{ route('admin.settings.faq.store') }}" enctype="multipart/form-data">
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

                                
                                @if(!empty(old('faq_title_' . $language->code)))

                                    @foreach(old('faq_title_' . $language->code) as $item)

                                        @include('admin.settings.faq.row', ['code' => $language->code, 'index' => $loop->index, 'uuid' => $loop->index, 'old' => true])

                                    @endforeach

                                @else

                                    @if(!empty(json_decode(getSetting('faq'), true)['title']))

                                        @foreach(json_decode(getSetting('faq'), true)['title'] as $item)

                                            @include('admin.settings.faq.row', ['code' => $language->code, 'index' => $loop->index, 'uuid' => $loop->index, 'old' => false])

                                        @endforeach

                                    @endif

                                @endif

                            </div>
                        @endforeach
                    </div>

                    <div class="form-group mt-3">
                        <button type="submit" id="add-items" class="btn btn-info col-12"><i class="fa fa-plus"></i>@lang('site.add')</button>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.create')</button>
                    </div>

                </div><!-- end of tile -->

            </div><!-- end of col -->

        </div><!-- end of row -->

    </form><!-- end of form -->

    <x-slot name="scripts">
        @include('admin.settings.faq.script')
    </x-slot>

</x-admin.layout.app>