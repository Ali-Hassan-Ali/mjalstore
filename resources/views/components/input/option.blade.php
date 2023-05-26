<div class="col-12 {{ $col }}">
    <div class="form-group">
        @if(!empty($label))
            <label>{{ trans($label) }} @if($required)<span class="text-danger">*</span>@endif</label>
        @endif
        {{ old(!empty($invalid) ? $invalid : $name, $value) }}
        <select {{ $multiple ? 'multiple=multiple' : '' }} name="{{ $name }}" class="form-control select2 @error(!empty($invalid) ? $invalid : $name) is-invalid @enderror" id="{{ $name }}">
            <option value="">@lang('site.choose')</option>
            @foreach($lists as $key=>$list)
                <option value="{{ $key }}" 
                @if($multiple)
                    {{ in_array($key ?? '', old(!empty($invalid) ? $invalid : $name, $value ?? []) ?? []) ? 'selected' : '' }}
                @else
                    {{ old(!empty($invalid) ? $invalid : $name, $value) == $key ? 'selected' : '' }}
                @endif
                >{{ $list }}</option>
            @endforeach
        </select>
        @error(!empty($invalid) ? $invalid : $name)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>