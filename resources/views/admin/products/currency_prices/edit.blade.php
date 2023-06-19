<x-admin.layout.app>

    <x-slot name="title">
        {{ trans('admin.global.edit') . ' - ' . trans('menu.currency_prices') }}
    </x-slot>

    <div>
        <h2>@lang('menu.currency_prices')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.index') }}">@lang('admin.global.home')</a></li>
        <li class="breadcrumb-item">@lang('menu.products')</li>
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.products.currency_prices.index') }}">@lang('menu.currency_prices')</a></li>
        <li class="breadcrumb-item">@lang('admin.global.edit')</li>
    </ul>

    <form method="post" action="{{ route('admin.products.currency_prices.update', $currencyPrice->id) }}" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="col-12 col-md-12">

            <div class="tile shadow">

                <div class="row">
                    
                    <div class="form-group col-12 col-md">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">{{ $currencyPrice->currency->code }}</span>
                            </div>
                            <input type="number" name="price" value="{{ old('price', $currencyPrice->price) }}" 
                                   class="form-control input-number @error('price') is-invalid @enderror" placeholder="@lang('admin.global.price')">
                        </div>
                        @error('price')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('admin.global.edit')</button>
                </div>

            </div><!-- end of tile -->

        </div><!-- end of col -->   

    </form><!-- end of form -->

</x-admin.layout.app>