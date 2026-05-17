<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->boolean('is_published')->default(false);
            $table->string('title');
            $table->string('slug');
            $table->text('lead')->nullable();
            $table->string('layout')->default('default');
            $table->string('main_image_url')->nullable();

            $table->unsignedBigInteger('content_id');
            $table->foreign('content_id')->references('id')->on('contents');

            $table->unsignedBigInteger('language_id')->nullable();
            $table->foreign('language_id')->references('id')->on('languages');

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
        Schema::dropIfExists('posts');
    }
}
