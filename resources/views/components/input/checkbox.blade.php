<div class="col-12 {{ $col }}">
    @if($label)
        <label class="form-check-label" for="{{ $name }}">{{ trans($label) }}</label>
    @endif
    <div class="form-group ml-3">
        <div class="form-check form-switch">
            <input class="form-check-input" id="{{ $name }}" type="checkbox" name="{{ $name }}" value="{{ $value }}" {{ old($name, $value) ? 'checked' : '' }}>
        </div>
    </div>
</div>