<div class="col-12 col-md">
    <div class="form-group">
        @if(isset($label))
            <label>{{ trans($label) }} @if($required)<span class="text-danger">*</span>@endif</label>
        @endif
        <input type="{{ $type }}" name="{{ $name }}" autofocus class="form-control" value="{{ old($name, $value) }}">
    </div>
</div>
