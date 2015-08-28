<?php 

namespace App\Transformers;


/**
 * Takes a raw tweet object and returns 
 */
class TwitterTransformer{


	protected $rawTweet;

	public function __construct($tweet){
		$this->rawTweet = $tweet;

		// manage Raw Twitter Object
		$retweeted = isset($tweet->retweeted_status) ? 1:0 ;
		$isreply = isset($tweet->in_reply_to_status_id) ? 1:0 ;
		$canonicalTweet = $retweeted? $tweet->retweeted_status : $tweet;
		$canonicalUser = $canonicalTweet->user;
	}

}

?>