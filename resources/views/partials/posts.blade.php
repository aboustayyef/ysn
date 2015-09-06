<script type="text/javascript">
	
	// store ID of latest post
	YouStinkApp.lastPostId = {{$posts[0]->id}};

</script>

<div class="posts">

	{{-- Shows list of possible sources --}}
	
	@include('partials.sourceControl')

	{{-- Where the action happens --}}

	<div id="stream" class="js-masonry" data-masonry-options='{ "itemSelector": ".cardsWrapper", "columWidth": 300, "gutter":10 }'>  
		@if(!$provider)
			@include('partials.whatsnew')
		@endif
	    @foreach($posts as $post)
	        @include('partials.card')
	    @endforeach

		@include('partials.bookend')

	</div>
</div>
