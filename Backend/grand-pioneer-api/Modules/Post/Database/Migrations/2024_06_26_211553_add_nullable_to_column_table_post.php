<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableToColumnTablePost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_sections', function (Blueprint $table) {
            $table->text('image_link')->nullable()->change();
            $table->string('image_name')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_sections', function (Blueprint $table) {
            $table->text('image_link')->nullable(false)->change();
            $table->string('image_name')->nullable(false)->change();
        });
    }
}
