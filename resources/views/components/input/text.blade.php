<div class="col-12 {{ $col }}">
    <div class="form-group">
        @if(!empty($label))
            <label>{{ trans($label) }} @if($required)<span class="text-danger">*</span>@endif</label>
        @endif
        <input type="{{ $type }}" name="{{ $name }}" autofocus class="form-control @error(!empty($invalid) ? $invalid : $name) is-invalid @enderror" value="{{ old($name, $value) }}">
        @error(!empty($invalid) ? $invalid : $name)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>