@if($permissions['update'])
    <a href="{{ $routeEdit }}" class="btn btn-warning btn-sm">
        <i class="fa fa-edit"></i> @lang('site.edit')
    </a>
@endif

@if($permissions['delete'])
    <form action="{{ $routeDelete }}" class="my-1 my-xl-0" method="post" style="display: inline-block;">
        @csrf
        @method('delete')

        <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i> @lang('site.delete')</button>
    </form>
@endif
