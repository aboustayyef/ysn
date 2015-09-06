<?php 

	// load facebookPosts;
	$facebookPosts = \Cache::get('facebookPosts');
	$post = $facebookPosts[0];

?>
	<div id="facebook" class="card autofloat">
		<h2 class="sectionhead">Latest Facebook Post</h2>
		@foreach($facebookPosts as $key=>$post)
			@if($key == 0)
				@if(isset($post['thumb']))
					<a href="{{$post['link']}}"><img src="{{$post['thumb']['src']}}" width="280" height="auto"></a>
				@endif
				<p>{!!nl2br($post['message'])!!} <a href="{{$post['link']}}">more</a></p>
			@else
				<hr>
				<?php $message = str_limit(nl2br($post['message']), 50); ?>
				<p>{!! $message !!} <a href="{{$post['link']}}">more</a></p>
			@endif
		@endforeach
		
	</div>