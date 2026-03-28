<?php

use Illuminate\Database\Migrations\Migration;

class CreateMenuItemTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // This migration is no longer needed as MenuItems are not translatable
        // The label and url fields are now directly in the menu_items table
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // This migration is no longer needed
    }
}
