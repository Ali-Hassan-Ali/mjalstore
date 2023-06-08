<div class="form-group ml-3">
  <div class="form-check form-switch">
    <input class="form-check-input default" id="default-{{ $currency->id }}" data-id="{{ $currency->id }}" 
    type="checkbox" name="id" value="{{ $currency->id }}" {{ $currency->default ? 'disabled checked' : '' }}>
  </div>
</div>