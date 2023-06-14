<x-admin.layout.app>
    <x-slot name="title">
        {{ trans('admin.global.create') . ' ' . trans('menu.payment_methods') }}
    </x-slot>

    <div>
        <h2>@lang('menu.payment_methods')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.index') }}">@lang('admin.global.home')</a></li>
        <li class="breadcrumb-item">@lang('menu.footers')</li>
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.footers.payment_methods.index') }}">@lang('menu.payment_methods')</a></li>
        <li class="breadcrumb-item">@lang('admin.global.create')</li>
    </ul>

    <form method="post" action="{{ route('admin.footers.payment_methods.store') }}" enctype="multipart/form-data">
        @csrf
        @method('post')

        <div class="row">

        	<div class="col-12 col-md-4">

                <div class="tile shadow">

                    @include('admin.dataTables.image_privew', ['name' => 'image', 'label' => 'admin.global.image', 'required' => true])

                </div><!-- end of tile -->

            </div><!-- end of col -->

            <div class="col-12 col-md-8">

                <div class="tile shadow">

                	<div class="row">

	                    {{--status--}}
	                    <x-input.checkbox :required="true" name="status" label="admin.global.status" col="col-md"/>

	                    {{--order--}}
	                    <x-input.text type="number" :required="true" name="order" label="admin.global.order" col="col-md"/>
                		
                	</div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('admin.global.create')</button>
                    </div>

                </div><!-- end of tile -->

            </div><!-- end of col -->

        </div><!-- end of row -->

    </form><!-- end of form -->

</x-admin.layout.app>
