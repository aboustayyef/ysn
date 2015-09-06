<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('updateme/{id}', function($id){
	$response = ['posts' => App\Post::numberOfPostsSinceId($id)];
	return response()->json($response);
});

Route::get('dumper', function(){
	$getter = new \App\Getters\FacebookGetter;
	$post = $getter->getList()[0];
	$post = (new \App\Transformers\FacebookTransformer($post))->get();
	return $post;
});

Route::get('/{provider?}', function($provider=null) {
	
	if ($provider) {
		
		// make sure the provider supported	
		if (!in_array($provider, ['facebook','youtube','instagram', 'lebaneseblogs', 'twitter'])) {
			return response('page does not exist',404);
		}

		// prepare posts. Cache if no cache
		$cacheRef = $provider . '__lastFiftyPosts';
		if (! \Cache::has($cacheRef)) {
		    \Cache::put($cacheRef , \App\Post::Where('provider', $provider)->orderBy('date_published','DESC')->take(50)->get() , 3);
		}
		$posts = \Cache::get($cacheRef);

	}else{
		// prepare posts. Cache if no cache
		if (! \Cache::has('lastFiftyPosts')) {
		    \Cache::put('lastFiftyPosts' , \App\Post::orderBy('date_published','DESC')->take(50)->get() , 3);
		}
		$posts = \Cache::get('lastFiftyPosts');
	}
    return view('layout')->with(['posts'=>$posts, 'provider'=>$provider]);
});