<div class="cardsWrapper">
	<div class="card">
		@if(isset($post->image_source) && $post->image_width > 0 )
			<?php $heighttowidth = $post->image_height / $post->image_width; ?>
			<div class="imagecontainer">
				<a href="{{$post->getLink()}}"><img src="{{$post->image_source}}" width="298" height = "{{298 * $heighttowidth}}"></a>
			</div>
		@endif

		<p>{!!$post->html_content!!}</p>

		<div class="userMeta">
			<div class="userImage"><img src="{{$post->user_profile_pic}}" width="48" height="48"></div>
			<div class="userInfo">
				<span class="name">{{$post->user_name}}</span><br>
				<span class="time"><a href="{{$post->getLink()}}">{{(new \Carbon\Carbon($post->date_published))->diffForHumans()}}</a></span>
			</div>
			<div class="provider">
				<a href="{{$post->getLink()}}">
					<img src="{{Asset('img/icons/' . $post->provider . '.png')}}" width="40px" height="40px">
				</a>
			</div>
		</div>
	</div>
</div>