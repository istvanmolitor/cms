<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostKeywordsTable extends Migration
{
    public function up()
    {
        Schema::create('post_keywords', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('keyword_id');

            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('keyword_id')->references('id')->on('keywords')->onDelete('cascade');

            $table->primary(['post_id', 'keyword_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('post_keywords');
    }
}
