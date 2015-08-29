<?php

namespace App\Console\Commands;

use App\Getters\TwitterGetter;
use Illuminate\Console\Command;

class Test2 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:test2';

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
        $twitterGetter = new TwitterGetter;
        $twitterPosts = $twitterGetter->getList('youstink', 2);

        foreach ($twitterPosts as $key => $post) {
            $transformedPost = new \App\Transformers\TwitterTransformer($post);
            var_dump($transformedPost->get());
        }
    }
}
