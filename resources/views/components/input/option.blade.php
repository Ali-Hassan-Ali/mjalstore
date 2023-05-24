<div class="col-12 {{ $col }}">
    <div class="form-group">
        {{ $name }}
        @if(!empty($label))
            <label>{{ trans($label) }} @if($required)<span class="text-danger">*</span>@endif</label>
        @endif
        <select name="{{ $name }}" class="form-control select2 @error(!empty($invalid) ? $invalid : $name) is-invalid @enderror" id="{{ $name }}">
            <option value="" selected disabled>@lang('site.choose')</option>
            @foreach($lists as $key=>$list)
                <option value="{{ $key }}" {{ $list == old(!empty($invalid) ? $invalid : $name) ? 'selected' : '' }}>{{ $list }}</option>
            @endforeach
        </select>
        @error(!empty($invalid) ? $invalid : $name)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>