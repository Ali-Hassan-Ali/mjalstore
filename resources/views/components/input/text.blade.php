<div class="col-12 {{ $col }}">
    <div class="form-group">
        @if(!empty($label))
            <label for="{{ $name }}">{{ trans($label) }} @if($required)<span class="text-danger">*</span>@endif</label>
        @endif
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" autofocus class="form-control @error(!empty($invalid) ? $invalid : $name) is-invalid @enderror" value="{{ old(!empty($invalid) ? $invalid : $name, $value) }}">
        @error(!empty($invalid) ? $invalid : $name)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>