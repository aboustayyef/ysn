<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
	protected $guarded = ['id','created_at', 'udpated_at'];

    //

	public static function has($postId){
		return (Post::where('post_id', (string) $postId)->get()->count()) > 0 ;
	}

	public function getLink(){
		if ($this->provider == 'instagram') {
			return $this->post_id;
		}
		// otherwise
		return 'https://twitter.com/' . $this->user_name . '/status/' . $this->post_id;

	}
}
