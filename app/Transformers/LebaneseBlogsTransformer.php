<?php 

namespace App\Transformers;
use Carbon\Carbon;

/**
 * Takes a raw tweet object and returns 
 */
class LebaneseBlogsTransformer extends _Transformer{

	function getPostId(){
		return $this->rawPost->post_url;
	}
	
	function getImageSource(){
		$this->image = $this->rawPost->post_image;
		return $this->image;
	}

	function getImageHeight(){
		$this->image_height = $this->rawPost->post_image_height;
		return $this->image_height;
	}

	function getImageWidth(){
		$this->image_width = $this->rawPost->post_image_width;
		return $this->image_width;
	}
	
	function getDatePublished(){
		return Carbon::createFromTimestamp($this->rawPost->post_timestamp);
	}
	
	function getHtmlContent(){
		return nl2br($this->rawPost->post_title);
	}
	
	function getUserProfilePic(){
		return 'http://static1.lebaneseblogs.com/' . $this->rawPost->blog->blog_id . '.jpg' ;
	}
	
	function getUserName(){
		return $this->rawPost->blog->blog_name;
	}
	

	function getProvider(){
		return "lebaneseblogs";
	}



}

?>