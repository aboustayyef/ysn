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
		if ($this->provider == 'youtube') {
			return 'https://www.youtube.com/watch?v=' . $this->post_id;
		}
		if ($this->provider == 'lebaneseblogs') {
			return 'http://' . $this->post_id;
		}
		if ($this->provider == 'facebook'){
			return 'https://www.facebook.com/'. $this->post_id;
		}
		// otherwise
		return 'https://twitter.com/' . $this->user_name . '/status/' . $this->post_id;

	}

	public static function numberOfPostsSinceId($id){
		$dateOfLastPost = Post::findOrFail($id)->date_published;
		return Post::where('date_published','>',$dateOfLastPost)->get()->count();
	}
}
