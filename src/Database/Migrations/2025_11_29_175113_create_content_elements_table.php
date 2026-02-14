<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_elements', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('content_id');
            $table->foreign('content_id')->references('id')->on('contents');

            $table->unsignedBigInteger('content_element_type_id');
            $table->foreign('content_element_type_id')->references('id')->on('content_element_types');

            $table->longText('content');

            $table->boolean('is_visible')->default(true);
            $table->integer('sort')->default(0);

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
        Schema::dropIfExists('content_elements');
    }
}
