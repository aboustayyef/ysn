<?php 

	// load blog posts
	if (!\Cache::has('latestBlogPosts')) {
		$latestBlogPosts = @file_get_contents('http://lebaneseblogs.com/youstink');
		Cache::put('latestBlogPosts', $latestBlogPosts, 30);
	}

	// load youtube videos
	$youtubeVideos = \Cache::get('youtubePosts');

?>
<div class="cardsWrapper">

	<div id="videos" class="card">
		<h2 class="sectionhead">Latest Youtube Videos</h2>
		<ul>
			@foreach ($youtubeVideos as $key => $video)
				<li>
					<div class="thumb" height="90" width="120">
						<a href="{{$video['link']}}"><img src="{{$video['thumb']}}" height="90" width="120"></a>
					</div>
					<div class="info">
						<a href="{{$video['link']}}">{{$video['title']}}</a>
						<br>
						<span class="channel">{{$video['channel']}}</span>
					</div>
				</li>	
			@endforeach
		</ul>
	</div>
	
	<div id="blogposts" class="card">
		<h2 class="sectionhead">Latest Blog Posts</h2>
		{!!\Cache::get('latestBlogPosts')!!}
	</div>

</div>