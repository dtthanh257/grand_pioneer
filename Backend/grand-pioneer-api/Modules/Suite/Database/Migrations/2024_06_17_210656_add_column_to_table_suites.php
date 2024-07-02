<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToTableSuites extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suites', function (Blueprint $table) {
            $table->integer('bed_number');
            $table->float('suite_size');
            $table->float('sundeck_size');
            $table->integer('number_of_adult');
            $table->integer('number_of_children');
            $table->integer('number_of_bathroom');
            $table->float('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suites', function (Blueprint $table) {
            $table->dropColumn('bed_number');
            $table->dropColumn('suite_size');
            $table->dropColumn('sundeck_size');
            $table->dropColumn('number_of_adult');
            $table->dropColumn('number_of_children');
            $table->dropColumn('number_of_bathroom');
            $table->dropColumn('price');
        });
    }
}
