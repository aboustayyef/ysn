<?php 

// prepare posts. Cache if no cache
if (! \Cache::has('lastThirtyPosts')) {
    \Cache::put('lastThirtyPosts' , \App\Post::orderBy('date_published','DESC')->take(30)->get() , 3);
}

$posts = \Cache::get('lastThirtyPosts');

?>

<div class="posts js-masonry" data-masonry-options='{ "itemSelector": ".card", "columWidth": 300, "gutter":10 }'>  
   
    @foreach($posts as $post)
        @include('partials.card')
    @endforeach

</div>