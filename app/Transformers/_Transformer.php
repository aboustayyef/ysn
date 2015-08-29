<?php 

namespace App\Transformers;


/**
 * Takes a raw tweet object and returns 
 */
abstract class _Transformer{


	protected $rawPost, $finalPost;

	public function __construct($rawPost){
		
		$this->rawPost = $rawPost;

	}


	abstract function getPostId();
	abstract function getImageSource();
	abstract function getImageWidth();
	abstract function getImageHeight();
	abstract function getDatePublished();
	abstract function getHtmlContent();
	abstract function getUserProfilePic();
	abstract function getUserName();
	abstract function getProvider();


	public function get(){

		$this->finalPost = [
			'post_id'			=> 	$this->getPostId(),
			'image_source'		=>	$this->getImageSource(),
			'image_height'		=>	$this->getImageHeight(),
			'image_width'		=>	$this->getImageWidth(),
			'date_published'	=>	$this->getDatePublished(),
			'html_content'		=>	$this->getHtmlContent(),
			'user_profile_pic'	=>	$this->getUserProfilePic(),
			'user_name'			=>	$this->getUserName(),
			'provider'			=>	$this->getProvider(),
		];
		
		return $this->finalPost;
	}

}

?>