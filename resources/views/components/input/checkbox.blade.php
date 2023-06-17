<div class="{{ $col }}" id="{{ $name }}-hidden" {{ $hidden ? 'hidden=hidden' : '' }}>
    @if($label)
        <label class="form-check-label" for="{{ $name }}">{{ trans($label) }}</label>
    @endif
    <div class="form-group ml-3">
        <div class="form-check form-switch">
            <input {{ $readonly ? 'readonly' : '' }} {{ $disabled ? 'disabled' : '' }} class="form-check-input" id="{{ $name }}" type="checkbox" name="{{ $name }}" value="{{ $value }}" {{ old($name, $value) ? 'checked' : '' }} {{ $disabled ? 'disabled=disabled' : '' }}>
        </div>
    </div>
</div>