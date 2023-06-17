<div class="form-group ml-3">
    <div class="form-check form-switch">
        <input class="form-check-input checkbox" data-type="{{ $type }}" id="{{ $type }}-{{ $models->id }}" data-id="{{ $models->id }}"
               type="checkbox" name="id" value="{{ $models->id }}" {{ $models[$type] ? 'checked' : '' }}>
    </div>
</div>