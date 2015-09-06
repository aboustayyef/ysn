<?php 

namespace App\Transformers;
use Carbon\Carbon;

/**
 * Takes a raw tweet object and returns 
 */
class InstagramTransformer extends _Transformer{

	protected $image = null, $image_height = 0, $image_width = 0;
	
	function getPostId(){
		return $this->rawPost->link;
	}
	
	function isPopular($threshold = 20){
		return $this->rawPost->likes->count > $threshold ;
	}

	function getImageSource(){
		$this->image = $this->rawPost->images->low_resolution->url;
		if ($this->image) {
			//have image, check dimensions
			$FastImageSize = new \FastImageSize\FastImageSize();
			$imageSize = $FastImageSize->getImageSize($this->image);
			$this->image_height = $imageSize['height'];
			$this->image_width = $imageSize['width'];
		}
	
		return $this->image;
	}

	function getImageHeight(){
		return $this->image_height;
	}

	function getImageWidth(){
		return $this->image_width;
	}
	
	function getDatePublished(){
		return Carbon::createFromTimeStamp($this->rawPost->created_time);
	}
	
	function getHtmlContent(){
		return $this->rawPost->caption->text;
	}
	
	function getUserProfilePic(){
		return $this->rawPost->caption->from->profile_picture;
	}
	
	function getUserName(){
		return $this->rawPost->caption->from->username;
	}
	

	function getProvider(){
		return "instagram";
	}



}

?>