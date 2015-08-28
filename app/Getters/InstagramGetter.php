<?php 

namespace App\Getters;

use MetzWeb\Instagram\Instagram;

class InstagramGetter 
{
	
	protected $client;
	protected $posts;
	function __construct(){
		$this->client = new Instagram(env('INSTAGRAM_APP_ID'));
	}

	public function get($tag="youstink" , $howmany=10){

		$this->posts = $this->client->getTagMedia($tag, $howmany);
	}

	public function show(){

		if (!isset($this->posts)) {
			$this->get();
		}

		foreach ($this->posts as $key => $post) {
			var_dump($post);
		}

	}
}

?>