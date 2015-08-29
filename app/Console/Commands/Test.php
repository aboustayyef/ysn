<?php

namespace App\Console\Commands;

use App\Getters\InstagramGetter;
use Illuminate\Console\Command;
use App\Transformers\InstagramTransformer;
class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:test';

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
        $instagramGetter = new InstagramGetter;
        $instagramPosts = $instagramGetter->getList('youstink', 20);

        foreach ($instagramPosts as $key => $post) {
            var_dump((new InstagramTransformer($post))->get());
            $this->info('=====================================');
        }
    }
}
