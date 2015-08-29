<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Post;
use \Cache;

class getLatestPosts extends Command
{

    protected $hashtags, $postsPerHashtag;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->hashtags = ['طلعت_ريحتكم', 'youstink'];
        $this->postsPerHashtag = 15;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // for each hashtag
        //      get twitter
        //          For each
        //              transform
        //              store
        //      get Instagram
        //          for each
        //              transform
        //              store
        //

        foreach ($this->hashtags as $key => $hashtag) {
            
            $this->comment("Gathering posts for hastag $hashtag");

            /**
             * get twitter posts
             */

            $twitterGetter = new \App\Getters\TwitterGetter;

            $this->info('getting tweets');
            $tweets = $twitterGetter->getList($hashtag, $this->postsPerHashtag);

            // transform tweets
            foreach ($tweets as $key => $tweet) {
                $twitterTransformer = new \App\Transformers\TwitterTransformer($tweet);
                $currentTweet = $twitterTransformer->get();

                // store if it doesn't already exist
                if (! Post::has($currentTweet['post_id'])) {
                    Post::create($currentTweet);
                }
                
            }

            /**
             * get Instagram posts
             */
            $instagramGetter = new \App\Getters\InstagramGetter;

            $this->info('getting instagram Posts');

            $posts = $instagramGetter->getList($hashtag, $this->postsPerHashtag);

            // transform posts
            foreach ($posts as $key => $post) {
                $instagramTransformer = new \App\Transformers\InstagramTransformer($post);
                $currentPost = $instagramTransformer->get();

                //check if post is stored. If not, store it;
                if (! Post::has($currentPost['post_id'])) {
                    Post::create($currentPost);
                }
            }

        }

        // Cache last 30 posts
        $this->comment('Caching last thrity posts');
        $lastThirtyPosts = \App\Post::orderBy('date_published','DESC')->take(30)->get();
        Cache::put('lastThirtyPosts', $lastThirtyPosts, 5);
    }
}
