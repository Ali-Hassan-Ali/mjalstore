<x-admin.layout.app>
    <x-slot name="title">
        {{ trans('admin.global.show') . ' ' . trans('menu.contact_us') }}
    </x-slot>

    <div>
        <h2>@lang('menu.contact_us')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.index') }}">@lang('admin.global.home')</a></li>
        <li class="breadcrumb-item">@lang('menu.footers')</li>
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.footers.contact_us.index') }}">@lang('menu.contact_us')</a></li>
        <li class="breadcrumb-item">@lang('admin.global.show')</li>
    </ul>

    <div class="col-12 col-md-12">

        <div class="tile shadow">

        	<div class="row">

                {{--name--}}
                <x-input.text :readonly="true" label="admin.global.name" col="col-12 col-md-6" :value="$contactU->name"/>

                {{--email--}}
                <x-input.text :readonly="true" label="admin.global.email" col="col-12 col-md-6" :value="$contactU->email"/>

                {{--subject--}}
                <x-input.text :readonly="true" label="admin.footers.contact_us.subject" col="col-12 col-md-6" :value="$contactU->subject"/>

                {{--status--}}
                <x-input.checkbox :disabled="true" name="status" label="admin.global.status" col="col-12 col-md-6" :value="$contactU->status"/>

                {{--body--}}
                <x-input.textarea :readonly="true" label="admin.footers.contact_us.body" col="col-md-12" :value="$contactU->body" rows="6"/>
        		
        	</div>

            <div class="form-group">
                <a href="{{ route('admin.footers.contact_us.index') }}" class="btn btn-primary"><i class="fa fa-back"></i>@lang('admin.global.back')</a>
            </div>

        </div><!-- end of tile -->

    </div><!-- end of col -->

</x-admin.layout.app>