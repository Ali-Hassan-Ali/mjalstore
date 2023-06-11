<div class="breadcrumb-bar">
    <div class="container">
        <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href="{{ route('site.index') }}"><i class="fa fa-home"></i></a></li>
           @foreach($breadcrumb as $key=>$item)
                @if($key == '#')
                    <li class="breadcrumb-item">
                        {{ $item }}
                    </li>
                @else
                    <li class="breadcrumb-item">
                        <a href="{{ $key }}">
                            {{ $item }}
                        </a>
                    </li>
                @endif
           @endforeach
        </ol>
    </div>
</div>