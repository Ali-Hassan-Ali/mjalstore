@if(!empty($permissions['update']) && !empty($routeEdit))
    <a href="{{ $routeEdit }}" class="btn btn-warning btn-sm">
        <i class="fa fa-edit"></i> @lang('admin.global.edit')
    </a>
@endif

@if(!empty($permissions['delete']) && !empty($routeDelete))
    <form action="{{ $routeDelete }}" class="my-1 my-xl-0" method="post" style="display: inline-block;">
        @csrf
        @method('delete')

        <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i> @lang('admin.global.delete')</button>
    </form>
@endif

@if(!empty($permissions['read']) && !empty($routeRead))
    <a href="{{ $routeRead }}" class="btn btn-info btn-sm">
        <i class="fa fa-eye"></i> @lang('admin.global.show')
    </a>
@endif