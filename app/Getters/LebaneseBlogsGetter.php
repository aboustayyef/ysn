<?php 

namespace App\Getters;

use Twitter;

class LebaneseBlogsGetter 
{
	
	protected $posts;

	public function getList($howmany=10){

		$this->posts = json_decode(file_get_contents('http://lebaneseblogs.com/youstink2/' . $howmany));

		return $this->posts;
	}

}

?>