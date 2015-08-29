<?php 

namespace App\Transformers;
use Carbon\Carbon;
use App\Parsers\TweetContentParser;

/**
 * Takes a raw tweet object and returns 
 */
class TwitterTransformer extends _Transformer{

	protected $tweet, $retweeted, $canonicalTweet, $canonicalUser;

	public function __construct($rawPost){
		
		parent::__construct($rawPost);

		$this->tweet = $this->rawPost;

		// prepare Raw Twitter Object. Find out if it's a retweet or not;

		$this->retweeted = isset($this->tweet->retweeted_status) ? 1:0 ;
		$this->canonicalTweet = $this->retweeted? $this->tweet->retweeted_status : $this->tweet;
		$this->canonicalUser = $this->canonicalTweet->user;

	}

	function getPostId(){
		return $this->canonicalTweet->id;
	}
	
	function getImageSource(){
		
		if (isset($this->canonicalTweet->entities->media[0]->media_url)){
			$media = $this->canonicalTweet->entities->media[0]->media_url;
		
		}
	}
	
	function getDatePublished(){
		return (new Carbon)->parse($this->tweet->created_at);
	}
	
	function getHtmlContent(){
		$html = new TweetContentParser($this->canonicalTweet);
		return $html->parse();
	}
	
	function getUserProfilePic(){
		return $this->canonicalUser->profile_image_url;
	}
	
	function getUserName(){
		return $this->canonicalUser->screen_name;
	}
	
	function getProvider(){
		return "twitter";
	}



}

?>