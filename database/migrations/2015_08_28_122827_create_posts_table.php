<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('post_id');
            $table->string('image_source')->nullable();
            $table->integer('image_height')->nullable();
            $table->integer('image_width')->nullable();
            $table->timestamp('date_published');
            $table->text('html_content');
            $table->string('user_profile_pic');
            $table->string('user_name');
            $table->integer('user_id');
            $table->string('provider');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('posts');
    }
}
