<?php

namespace App\Console\Commands;

use \Youtube;
use Illuminate\Console\Command;

class GetLatestYoutube extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'youtube:get';
    protected $youtubePosts = [];
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gets and Caches latest Youtube posts';

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
        $listOfTerms = ['طلعت ريحتكم'];
        $resultsPerTerm = 5;

        foreach ($listOfTerms as $key => $term) {
            $posts = Youtube::searchVideos($term, $resultsPerTerm, 'date');
            foreach ($posts as $key => $post) {
                $this->youtubePosts[] = [
                    'title'         => $post->snippet->title,
                    'link'          => 'https://www.youtube.com/watch?v=' . $post->id->videoId,
                    'channel'       => $post->snippet->channelTitle,
                    'thumb'         => $post->snippet->thumbnails->default->url
                ];
            }
        }
        \Cache::put('youtubePosts', $this->youtubePosts, 20);
    }
}
