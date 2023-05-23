<x-admin.layout.app>

    <x-slot name="title">{{ trans('menu.languages') }}</x-slot>

    <div><h2>{{ trans('menu.languages') }}</h2></div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.index') }}">
                {{ trans('site.home') }}
            </a>
        </li>
        <li class="breadcrumb-item">{{ trans('menu.languages') }}</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <div class="row mb-2">

                    <div class="col-md-12">

                        @if(permissionAdmin('create-languages'))
                            <a href="{{ route('admin.managements.languages.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.create')</a>
                        @endif

                        @if(permissionAdmin('create-languages'))
                            <form method="post" action="{{ route('admin.managements.languages.bulk_delete') }}" style="display: inline-block;">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="record_ids" id="record-ids">
                                <button type="submit" class="btn btn-danger" id="bulk-delete" disabled="true"><i class="fa fa-trash"></i> @lang('site.bulk_delete')</button>
                            </form><!-- end of form -->
                        @endif

                    </div>

                </div><!-- end of row -->

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" id="data-table-search" class="form-control" autofocus placeholder="@lang('site.search')">
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
    	<script>
    		$(document).on('change', '.default', function (e) {
	            e.preventDefault();

	            let url    = "{{ route('admin.managements.languages.default') }}";
	            let method = 'post';
	            let id     = $(this).data('id');

	            $.ajax({
	                url: url,
	                data: {id: id},
	                method: method,
	                success: function (response) {

	                    $('.datatable').DataTable().ajax.reload();

	                    new Noty({
	                        layout: 'topRight',
	                        type: 'alert',
	                        text: response,
	                        killer: true,
	                        timeout: 2000,
	                    }).show();
	                },

	            });//end of ajax call

	        });//end of delete
    	</script>

        <x-admin.datatable.script :datatables='$datatables'/>
    </x-slot>

</x-admin.layout.app>
