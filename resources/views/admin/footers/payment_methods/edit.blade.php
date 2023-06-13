<x-admin.layout.app>
    <x-slot name="title">
        {{ trans('site.create') . ' ' . trans('menu.payment_methods') }}
    </x-slot>

    <div>
        <h2>@lang('menu.payment_methods')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.index') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('menu.footers')</li>
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.footers.payment_methods.index') }}">@lang('menu.payment_methods')</a></li>
        <li class="breadcrumb-item">@lang('site.create')</li>
    </ul>

    <form method="post" action="{{ route('admin.footers.payment_methods.update', $paymentMethod->id) }}" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="row">

        	<div class="col-12 col-md-4">

                <div class="tile shadow">

                    @include('admin.dataTables.image_privew', ['name' => 'image', 'imagepath' => $paymentMethod->image_path, 'label' => 'image', 'required' => true])

                </div><!-- end of tile -->

            </div><!-- end of col -->

            <div class="col-12 col-md-8">

                <div class="tile shadow">

                	<div class="row">

	                    {{--status--}}
	                    <x-input.checkbox :required="true" name="status" label="admin.global.status" col="col-md" :value="$paymentMethod->status"/>

	                    {{--order--}}
	                    <x-input.text type="number" :required="true" name="order" label="admin.global.order" col="col-md" :value="$paymentMethod->order"/>
                		
                	</div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.create')</button>
                    </div>

                </div><!-- end of tile -->

            </div><!-- end of col -->

        </div><!-- end of row -->

    </form><!-- end of form -->

</x-admin.layout.app>
