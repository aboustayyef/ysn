<?php 

namespace App\Getters;

use \Youtube;

class YoutubeGetter 
{
	
	protected $client;
	protected $posts;
	function __construct(){
		#nothing
	}

	public function getList( $hashtag = 'youstink' , $howmany = 5){

		$posts = Youtube::searchVideos($hashtag, $howmany, 'date');
		return $posts ;
	}
}

?>