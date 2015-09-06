<script type="text/javascript">
	
	// store ID of latest post
	YouStinkApp.lastPostId = {{$posts[0]->id}};

</script>

<div class="posts">

	@include('partials.sourceControl')
	<div id="stream" class="js-masonry" data-masonry-options='{ "itemSelector": ".cardsWrapper", "columWidth": 300, "gutter":10 }'>  

	    @foreach($posts as $post)
	        @include('partials.card')
	    @endforeach

		@include('partials.bookend')

	</div>
</div>
