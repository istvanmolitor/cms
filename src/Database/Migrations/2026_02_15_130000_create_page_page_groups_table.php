<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagePageGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_page_groups', function (Blueprint $table) {
            $table->unsignedBigInteger('page_id');
            $table->unsignedBigInteger('page_group_id');

            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
            $table->foreign('page_group_id')->references('id')->on('page_groups')->onDelete('cascade');

            $table->primary(['page_id', 'page_group_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_page_groups');
    }
}
