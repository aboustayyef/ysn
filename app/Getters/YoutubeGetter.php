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

	public function getList( $howmany = 5, $hashtag = 'youstink' ){

		$posts = Youtube::searchVideos($hashtag, $howmany, 'date');
		return $posts ;
	}
}

?>