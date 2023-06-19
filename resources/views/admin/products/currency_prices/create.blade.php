<x-admin.layout.app>

    <x-slot name="title">
        {{ trans('admin.global.create') . ' - ' . trans('menu.currency_prices') }}
    </x-slot>

    <div>
        <h2>@lang('menu.currency_prices')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.index') }}">@lang('admin.global.home')</a></li>
        <li class="breadcrumb-item">@lang('menu.products')</li>
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.products.currency_prices.index') }}">@lang('menu.currency_prices')</a></li>
        <li class="breadcrumb-item">@lang('admin.global.create')</li>
    </ul>

    <form method="post" action="{{ route('admin.products.currency_prices.store') }}" enctype="multipart/form-data">
        @csrf
        @method('post')

        <div class="col-12 col-md-12">

            <div class="tile shadow">

                <div class="row">
                    
                    @foreach($currencies as $id=>$code)

                        <div class="form-group col-12 col-md-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ $code }}</span>
                                </div>
                                <input type="number" name="price[{{ $id }}]" value="{{ old('price.' . $id) }}" 
                                       class="form-control input-number @error('price.' . $id) is-invalid @enderror" placeholder="@lang('admin.global.price')">
                            </div>
                            @error('price.' . $id)
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    @endforeach


                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('admin.global.create')</button>
                </div>

            </div><!-- end of tile -->

        </div><!-- end of col -->   

    </form><!-- end of form -->

</x-admin.layout.app>