<?php 

	// load blog posts
	if (!\Cache::has('latestBlogPosts')) {
		$latestBlogPosts = @file_get_contents('http://lebaneseblogs.com/youstink');
		Cache::put('latestBlogPosts', $latestBlogPosts, 30);
	}

	// load youtube videos
	$youtubeVideos = \Cache::get('youtubePosts');

?>
	<div id="blogposts" class="card">
		<h2 class="sectionhead">Latest Blog Posts</h2>
		{!!\Cache::get('latestBlogPosts')!!}
	</div>
