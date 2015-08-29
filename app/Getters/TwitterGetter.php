<?php 

namespace App\Getters;

use Twitter;

class TwitterGetter 
{
	
	protected $client;
	protected $posts;
	function __construct(){
		$this->client = new Twitter(getenv('TWITTER_CONSUMER_KEY'), getenv('TWITTER_CONSUMER_SECRET'), getenv('TWITTER_ACCESS_TOKEN'),getenv('TWITTER_ACCESS_TOKEN_SECRET'));
	}

	public function getList($tag="youstink" , $howmany=10){

		try {
				$rawTweets = $this->client->request('search/tweets','GET',['q'=>$tag, 'count'=>$howmany]);
			} catch (Exception $e) {
				return "Exception: $e";
			}
			
			return $rawTweets->statuses;	
	}

}

?>