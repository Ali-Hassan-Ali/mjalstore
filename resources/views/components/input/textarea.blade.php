<div class="col-12 {{ $col }}">
    <div class="form-group">
        @if(!empty($label))
            <label>{{ trans($label) }} @if($required)<span class="text-danger">*</span>@endif</label>
        @endif
        <textarea id="{{ !empty($invalid) ? $invalid : $name }}" class="form-control @error(!empty($invalid) ? $invalid : $name) is-invalid @enderror" name="{{ $name }}" rows="{{ $rows }}">{{ old($name, $value) }}</textarea>
        @error(!empty($invalid) ? $invalid : $name)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>