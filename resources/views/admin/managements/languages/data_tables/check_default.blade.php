<div class="form-group ml-3">
  <div class="form-check form-switch">
    <input class="form-check-input default" id="default-{{ $language->id }}" data-id="{{ $language->id }}" 
    type="checkbox" name="id" value="{{ $language->id }}" {{ $language->default ? 'disabled checked' : '' }}>
  </div>
</div>