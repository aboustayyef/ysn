<?php 

namespace App\Transformers;
use Carbon\Carbon;

/**
 * Takes a raw tweet object and returns 
 */
class InstagramTransformer extends _Transformer{

	
	function getPostId(){
		return $this->rawPost->link;
	}
	
	function getImageSource(){
		return $this->rawPost->images->low_resolution->url;
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