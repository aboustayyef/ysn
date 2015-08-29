<?php 

namespace App\Transformers;
use Carbon\Carbon;
use App\Parsers\TweetContentParser;

/**
 * Takes a raw tweet object and returns 
 */
class TwitterTransformer extends _Transformer{

	protected $tweet, $retweeted, $canonicalTweet, $canonicalUser, $image = null, $image_height = 0, $image_width = 0;

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
			$this->image = $this->canonicalTweet->entities->media[0]->media_url;
			
			// check dimensions
			$FastImageSize = new \FastImageSize\FastImageSize();
			$imageSize = $FastImageSize->getImageSize($this->image);
			$this->image_height = $imageSize['height'];
			$this->image_width = $imageSize['width'];
			return $this->image;
		}
	}

	function getImageHeight(){
		return $this->image_height;
	}

	function getImageWidth(){
		return $this->image_width;
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