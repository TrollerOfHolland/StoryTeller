<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChapters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapters', function (Blueprint $table) {
            $table->string('parentID');
            $table->string('chapterID');
            $table->string('chapterText');
            $table->string('backgroundPhoto');
            $table->string('option1ID');
            $table->string('option1Text');
            $table->string('option2ID');
            $table->string('option2Text');
            $table->string('option3ID');
            $table->string('option3Text');

            //Connection to book table
            /*$table->foreign('parentID')
                ->references('startingChapter')->on('book')
                ->onDelete('cascade');*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chapters');
    }
}
