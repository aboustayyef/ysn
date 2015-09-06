<?php 
	$options = [null, 'facebook','youtube','instagram', 'twitter', 'lebaneseblogs'];
	$titles = ['Show All Posts', 'Show Facebook Posts','Show Youtube Posts','Show Instagram Posts', 'Show Twitter Posts', 'Show Lebanese Blog Posts'];
	$images = ['all', 'facebook','youtube','instagram', 'twitter', 'lebaneseblogs'];
?>
<h2>
	<div class="source title">Source: </div>

	@foreach ($options as $key => $option) 
		<div class="source @if($provider == $option) active @endif">
			<a href="/{{$option}}" title="{{$titles[$key]}}">
				<img src="{{Asset('img/icons/' . $images[$key] . '.png')}}" alt="All Sources Icon">
			</a>
		</div>
	@endforeach

</h2>