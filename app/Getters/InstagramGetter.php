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

	public function getList($howmany=10, $tag="youstink"){

		$this->posts = $this->client->getTagMedia(urlencode($tag), $howmany);

		return $this->posts->data;
	}

}

?>