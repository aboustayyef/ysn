<?php 

namespace App\Getters;

use Facebook\Facebook;

class FacebookGetter 
{
	
	protected $client;
	protected $posts;
	function __construct(){
		$this->client = new Facebook([/**/]);
		$this->client->setDefaultAccessToken( getenv('FACEBOOK_APP_ID') . '|' . getenv('FACEBOOK_APP_SECRET') );
	}

	public function getList(){

		$this->posts = $this->client->get('/tol3etre7etkom/posts')->getDecodedBody();

		return $this->posts['data'];
	}

	public function getItem($id){
		$this->item = $this->client->get($id . '?fields=id,message,created_time,link,picture,status_type')->getDecodedBody();
		return $this->item;
	}

}

?>