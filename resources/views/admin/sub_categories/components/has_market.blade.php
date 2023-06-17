<div class="form-group ml-3">
    <div class="form-check form-switch">
        <input class="form-check-input has_market" {{ (bool) $subCategory->cards->count() ? 'disabled' : '' }} id="has_market-{{ $subCategory->id }}" data-id="{{ $subCategory->id }}"
               type="checkbox" name="id" value="{{ $subCategory->id }}" {{ (bool) $subCategory->has_market ? 'checked' : '' }}>
    </div>
</div>