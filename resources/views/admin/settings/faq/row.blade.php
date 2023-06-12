<div class="row {{ $uuid }}">

	<div class="col-1">
		<label>#</label>
		<button type="button" class="btn btn-danger remove-item" data-uuid="{{ $uuid }}">
			<i class="fa fa-trash m-auto"></i>
		</button>
	</div>

	<div class="col-11">
		@if(!empty(getMulteSetting('faq', 'title', $index, $code)) && $old == false)
			<x-input.text required="true" name="faq_title_{{ $code }}[]" label="site.faq_title" :value="getMulteSetting('faq', 'title', $index, $code)" :invalid="'faq_title_' . $code . '.' . $index"/>
		@else
			<x-input.text required="true" name="faq_title_{{ $code }}[]" label="site.faq_title" :value="old('faq_title_' . $code)[$index]" :invalid="'faq_title_' . $code . '.' . $index"/>
		@endif
	</div>
	@if(!empty(getMulteSetting('faq', 'description', $index, $code)) && $old == false)
		<x-input.textarea required="true" name="faq_description_{{ $code }}[]" label="site.faq_description" rows='6' col="col-12" :value="getMulteSetting('faq', 'description', $index, $code)" :invalid="'faq_description_' . $code . '.' . $index"/>
	@else
		<x-input.textarea required="true" name="faq_description_{{ $code }}[]" label="site.faq_description" rows='6' col="col-12" :value="old('faq_description_' . $code)[$index]" :invalid="'faq_description_' . $code . '.' . $index"/>
	@endif

</div>