<?php 

namespace App\Transformers;
use Carbon\Carbon;

/**
 * Takes a raw tweet object and returns 
 */
class YoutubeTransformer extends _Transformer{

	protected $channel;
	
	public function __construct($rawPost){
		
		parent::__construct($rawPost);
		$this->channel = \Youtube::getChannelById($this->rawPost->snippet->channelId);
	}

	function getPostId(){
		return $this->rawPost->id->videoId;
	}
	
	function getImageSource(){
		$this->image = $this->rawPost->snippet->thumbnails->medium->url;
		return $this->image;
	}

	function getImageHeight(){
		return 180;
	}

	function getImageWidth(){
		return 320;
	}
	
	function getDatePublished(){
		return new Carbon($this->rawPost->snippet->publishedAt);
	}
	
	function getHtmlContent(){
		return $this->rawPost->snippet->description;
	}
	
	function getUserProfilePic(){
		return $this->channel->snippet->thumbnails->medium->url;
	}
	
	function getUserName(){
		return $this->channel->snippet->title;
	}
	

	function getProvider(){
		return "youtube";
	}



}

?>