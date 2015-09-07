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
        $this->hashtags = ['#بدنا_نحاسب', '#youstink'];
        $this->postsPerHashtag = 30; // increased from 15 to 30 because of quality filtering
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
            
            /*
            * get Facebook & Lebanese Blogs posts. Get them only once, because not related to hashtags
            */
            
            /////////////
            //Facebook //
            /////////////

            if ($key == 0) {

                $facebookGetter = new \App\Getters\FacebookGetter;

                $this->info('Getting Facebook posts');
                $posts = $facebookGetter->getList();

                // transform posts
                foreach ($posts as $key => $post) {
                    $facebookTransformer = new \App\Transformers\FacebookTransformer($post);
                    
                    $currentPost = $facebookTransformer->get();
                    
                    // store if it doesn't already exist
                    if (! Post::has($currentPost['post_id'])) {
                        Post::create($currentPost);
                    }                
                }

                ///////////////////
                //Lebanese Blogs //
                ///////////////////

                $lebaneseBlogsGetter = new \App\Getters\LebaneseBlogsGetter;

                $this->info('Getting Lebanese blogs posts');
                $posts = $lebaneseBlogsGetter->getList();

                // transform posts
                foreach ($posts as $key => $post) {
                    $lebaneseBlogsTransformer = new \App\Transformers\LebaneseBlogsTransformer($post);
                    
                    $currentPost = $lebaneseBlogsTransformer->get();
                    
                    // store if it doesn't already exist
                    if (! Post::has($currentPost['post_id'])) {
                        Post::create($currentPost);
                    }                
                }
            }

            $this->comment("Gathering posts for hastag $hashtag");

            /**
             * get youtube posts
             */

            $ignoredHashtags = ['#youstink'];
    
            if (! in_array($hashtag, $ignoredHashtags)) {
                $youtubeGetter = new \App\Getters\YoutubeGetter;

                $this->info('getting youtube Videos');
                $videos = $youtubeGetter->getList($hashtag, $this->postsPerHashtag);

                // transform videos
                foreach ($videos as $key => $video) {
                    $youtubeTransformer = new \App\Transformers\YoutubeTransformer($video);
                    
                    $currentVideo = $youtubeTransformer->get();
                    
                    // store if it doesn't already exist
                    if (! Post::has($currentVideo['post_id'])) {
                        Post::create($currentVideo);
                    }                
                }
            } else {
                $this->info('Youtube ignores this hashtag');
            }

            /**
             * get twitter posts
             */

            $twitterGetter = new \App\Getters\TwitterGetter;

            $this->info('getting tweets');
            $tweets = $twitterGetter->getList($hashtag, $this->postsPerHashtag);

            // transform tweets
            foreach ($tweets as $key => $tweet) {
                $twitterTransformer = new \App\Transformers\TwitterTransformer($tweet);

                // should pass popularity test
                $popularityThreshold = 2 ; //minimum retweets and favorites (combined)
                
                if ($twitterTransformer->isPopular($popularityThreshold)) {
                    $currentTweet = $twitterTransformer->get();
                    // store if it doesn't already exist
                    if (! Post::has($currentTweet['post_id'])) {
                        Post::create($currentTweet);
                    }                
                }                
            }

            /**
             * get Instagram posts
             */
            $instagramGetter = new \App\Getters\InstagramGetter;

            $this->info('getting instagram Posts');

            // remove # for instagram search
            $nohashtag = ltrim($hashtag,'#');

            $posts = $instagramGetter->getList($nohashtag, $this->postsPerHashtag);

            // transform posts
            foreach ($posts as $key => $post) {
                $instagramTransformer = new \App\Transformers\InstagramTransformer($post);

                // should pass popularity test
                $popularityThreshold = 20 ; // minimum number of likes

                if ($instagramTransformer->isPopular($popularityThreshold)) {
                    $currentPost = $instagramTransformer->get();

                    //check if post is stored. If not, store it;
                    if (! Post::has($currentPost['post_id'])) {
                        Post::create($currentPost);
                    }                 } 
                }

        }

        // Cache last 50 posts
        $this->comment('Caching last fifty posts');
        $lastFiftyPosts = \App\Post::orderBy('date_published','DESC')->take(50)->get();
        Cache::put('lastFiftyPosts', $lastFiftyPosts, 5);
    }
}
