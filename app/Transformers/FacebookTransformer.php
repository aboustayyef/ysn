<?php 

namespace App\Transformers;
use Carbon\Carbon;
use App\Getters\FacebookGetter;

/**
 * Takes a raw tweet object and returns 
 */
class FacebookTransformer extends _Transformer{

	protected $channel, $item, $image = null, $image_height = 0, $image_width = 0;

	public function __construct($rawPost){
		parent::__construct($rawPost);
		$this->item = (new FacebookGetter)->getItem($this->rawPost['id']);
	}

	function getPostId(){
		return $this->rawPost['id'];
	}
	
	function getImageSource(){
        if (isset($this->item['attachments']['data'][0]['media']['image'])) {
            $this->image = $this->item['attachments']['data'][0]['media']['image']['src'];
            $this->image_height = $this->item['attachments']['data'][0]['media']['image']['height'];
            $this->image_width = $this->item['attachments']['data'][0]['media']['image']['width'];
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
		return new Carbon($this->item['created_time']);
	}
	
	function getHtmlContent(){
		if (isset($this->item['message'])) {
			return nl2br($this->item['message']);
		}
		return "";
	}
	
	function getUserProfilePic(){
		return 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xfa1/v/t1.0-1/p320x320/11947410_1029224703796782_5902742261473897901_n.png?oh=9c62f14bd73309d35afd0fda57965696&oe=5668A73C&__gda__=1449061232_db09b35713b8f895d83e8cbd4f2fc3e4';
	}
	
	function getUserName(){
		return 'Official Tol3it Ri7etkon Page';
	}
	

	function getProvider(){
		return "facebook";
	}



}

?>