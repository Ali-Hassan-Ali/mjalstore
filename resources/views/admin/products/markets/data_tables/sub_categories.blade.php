@if($market->subCategories()->count())
	<h5>
		@foreach($market->subCategories as $subCategory)
			<span class="badge badge-info">{{ $subCategory->name }}</span>
		@endforeach
	</h5>
@endif