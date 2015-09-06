<?php 
	$options = [null, 'facebook','youtube','instagram', 'twitter'];
	$images = ['all', 'facebook','youtube','instagram', 'twitter'];
?>
<h2>
	<div class="source">Source: </div>

	@foreach ($options as $key => $option) 
		<div class="source @if($provider == $option) active @endif">
			<a href="/{{$option}}">
				<img src="{{Asset('img/icons/' . $images[$key] . '.png')}}" alt="All Sources Icon">
			</a>
		</div>
	@endforeach

</h2>