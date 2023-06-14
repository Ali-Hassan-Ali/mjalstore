<x-admin.layout.app>

    <x-slot name="title">
        {{ trans('admin.global.edit') . ' - ' . trans('menu.cards') }}
    </x-slot>

    <x-slot name="style">
        <link href="{{ asset('admin_assets/css/cards.css') }}" rel="stylesheet">
    </x-slot>

    <div>
        <h2>@lang('menu.cards')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.index') }}">@lang('admin.global.home')</a></li>
        <li class="breadcrumb-item">@lang('menu.products')</li>
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.products.cards.index') }}">@lang('menu.cards')</a></li>
        <li class="breadcrumb-item">@lang('admin.global.edit')</li>
    </ul>

    <form method="post" action="{{ route('admin.products.cards.update', $card->id) }}" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="row">

            <div class="col-12 col-md-4">

                <div class="tile shadow">

                    @include('admin.sub_categories.components.cards', ['color1' => '#199afe', 'color2' => '#8f06fa', 
                            'subCategory' => old('name.' . getLanguages('default')->code, 'GOOGLE GM'), 
                            'title'       => old('title_card.' . getLanguages('default')->code, 'حمل ما تريد من ألعاب PC المدفوعة'),
                            'market'      => old('market_id', 'المتجر'),
                            'price'       => old('price', '0000')])

                </div><!-- end of tile -->

            </div><!-- end of col -->

            <div class="col-12 col-md-8">

                <div class="tile shadow">

                    <div class="row">

                        {{--categories--}}
                        <x-input.option required="true" name="category_id" label="menu.sub_categories" :lists="$categories" :value="old('category', $card?->subCategory?->parent_id)" col="col-md"/>

                        {{--sub categories--}}
                        <x-input.option required="true" name="sub_category" :disabled='old("sub_category", $card?->category_id) ? false : true' label="menu.sub_categories" :lists="$subCategories" :value="old('sub_category', $card?->category_id)" col="col-md"/>

                        {{--markets--}}
                        <x-input.option name="market_id" label="menu.markets" :lists="$markets" :hidden='old("market_id", $card->market_id) ? false : true' :value="old('market_id', $card->market_id)" col="col-md"/>

                        {{--price--}}
                        <x-input.text type="number" required="true" name="price" label="admin.global.price" :value="$card->price" col="col-md-6"/>

                        {{--quantity--}}
                        <x-input.text type="number" required="true" name="quantity" label="admin.products.cards.quantity" :value="$card->quantity" col="col-md-6"/>

                        {{--balance--}}
                        <x-input.text type="number" required="true" name="balance" label="admin.products.cards.balance" :value="old('balance', $card->balance)" col="col-md-6"/>

                        {{--rating--}}
                        <x-input.option required="true" name="rating" label="admin.products.cards.rating" :lists="$ratings" :value="old('rating', $card->rating)" col="col-md-6"/>

                        {{--status--}}
                        <x-input.checkbox :required="true" name="status" label="admin.global.status" col="col-md" :value="$card->status"/>

                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('admin.global.edit')</button>
                    </div>

                </div><!-- end of tile -->

            </div><!-- end of col -->

        </div><!-- end of row -->

    </form><!-- end of form -->

    <x-slot name="scripts">
        @include('admin.products.cards.components.scripts')
    </x-slot>

</x-admin.layout.app>