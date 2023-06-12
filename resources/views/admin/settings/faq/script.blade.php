<script type="text/javascript">
	$(document).ready(function () {

		$(document).on('click', '#add-items', function (e) {
			e.preventDefault();

			let languages = @json(getLanguages()->pluck('code')->toArray());
			let uuid      = $.now();

			$.each(languages, function(index, code) {
				
				let html = `<div class="row ${uuid}">

								<div class="col-1">
									<label>#</label>
									<button type="button" class="btn btn-danger remove-item" data-uuid="${uuid}">
										<i class="fa fa-trash m-auto"></i>
									</button>
								</div>

								<div class="col-11">
									<x-input.text required="true" name="faq_title_${code}[]" label="site.faq_title"/>
								</div>

								<x-input.textarea required="true" name="faq_description_${code}[]" label="site.faq_description" rows='6' col="col-12"/>

							</div>`;

			    $('#' + code).append(html);
			});

		});//end of click add-items

		$(document).on('click', '.remove-item', function (e) {
			e.preventDefault();

			let uuid = $(this).data('uuid');

			$('.' + uuid).remove();


		});//end of document ready

	});//end of document ready
</script>