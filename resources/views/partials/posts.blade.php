<?php 

// prepare posts. Cache if no cache
if (! \Cache::has('lastThirtyPosts')) {
    \Cache::put('lastThirtyPosts' , \App\Post::orderBy('date_published','DESC')->take(30)->get() , 3);
}

$posts = \Cache::get('lastThirtyPosts');

?>

<script type="text/javascript">
	
	// store ID of latest post
	YouStinkApp.lastPostId = {{$posts[0]->id}};

</script>


<div class="posts js-masonry" data-masonry-options='{ "itemSelector": ".cardsWrapper", "columWidth": 300, "gutter":10 }'>  
   
	@include('partials.blogs_and_videos')

    @foreach($posts as $post)
        @include('partials.card')
    @endforeach

	@include('partials.bookend')

</div>