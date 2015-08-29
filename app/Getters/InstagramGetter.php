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

	public function getList($tag="youstink" , $howmany=10){

		$this->posts = $this->client->getTagMedia($tag, $howmany);
		return $this->posts->data;
	}

}

?>