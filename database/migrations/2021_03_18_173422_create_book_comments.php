<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_comments', function (Blueprint $table) {
            $table->bigInteger('bookID')->unsigned();
            $table->bigInteger('commentID')->unsigned();

            //Connection to book table
            $table->foreign('bookID')
                ->references('id')->on('book')
                ->onDelete('cascade');

            //Connection to comments table
            $table->foreign('commentID')
                ->references('id')->on('comments')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_comments');
    }
}
