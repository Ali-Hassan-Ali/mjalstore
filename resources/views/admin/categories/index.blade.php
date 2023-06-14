<x-admin.layout.app>

    <x-slot name="title">{{ trans('menu.category') }}</x-slot>

    <div><h2>{{ trans('menu.category') }}</h2></div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.index') }}">
                {{ trans('admin.global.home') }}
            </a>
        </li>
        <li class="breadcrumb-item">{{ trans('menu.category') }}</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <div class="row mb-2">

                    <div class="col-md-12">

                        @if(permissionAdmin('create-categories'))
                            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('admin.global.create')</a>
                        @endif

                        @if(permissionAdmin('create-categories'))
                            <form method="post" action="{{ route('admin.categories.bulk_delete') }}" style="display: inline-block;">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="record_ids" id="record-ids">
                                <button type="submit" class="btn btn-danger" id="bulk-delete" disabled="true"><i class="fa fa-trash"></i> @lang('admin.global.bulk_delete')</button>
                            </form><!-- end of form -->
                        @endif

                    </div>

                </div><!-- end of row -->

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" id="data-table-search" class="form-control" autofocus placeholder="@lang('admin.global.search')">
                        </div>
                    </div>

                </div><!-- end of row -->

                <div class="row">

                    <div class="col-md-12">

                        <div class="table-responsive">

                            <table class="table datatable" id="data-table" style="width: 100%;">
                                <x-admin.data-table.header :columns='$datatables["header"]'/>
                            </table>

                        </div><!-- end of table responsive -->

                    </div><!-- end of col -->

                </div><!-- end of row -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

    <x-slot name="scripts">
        <x-admin.datatable.script :datatables='$datatables'/>
    </x-slot>

</x-admin.layout.app>
