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
    protected $signature = 'posts:get {provider} {howmany=20} {hashtag?} {qualityThreshold?}';

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
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {         
        $hashtag = $this->argument('hashtag');
        $GetterClass = '\App\Getters\\' . $this->argument('provider') . 'Getter';
        $TransformerClass = 'App\Transformers\\' . $this->argument('provider') . 'Transformer';

        $getter = new $GetterClass;

        $this->info('Getting posts from ' . $this->argument('provider') );

        $posts = $getter->getList($this->argument('howmany'), $this->argument('hashtag'));

        // transform posts
        foreach ($posts as $key => $post) {
            $transformer = new $TransformerClass($post);
            
            $currentPost = $transformer->get();

            // store if it doesn't already exist
            if (! Post::has($currentPost['post_id'])) {

                // check if post is popular enough
                if ($this->argument('qualityThreshold')) {
                    if ($transformer->isPopular($this->argument('qualityThreshold'))) {
                       Post::create($currentPost);
                    }
                } else{
                    Post::create($currentPost);
                }
            }                
        }

        // Cache last 50 posts
        $this->comment('Caching last fifty posts');
        $lastFiftyPosts = \App\Post::orderBy('date_published','DESC')->take(50)->get();
        Cache::put('lastFiftyPosts', $lastFiftyPosts, 5);
    }
}