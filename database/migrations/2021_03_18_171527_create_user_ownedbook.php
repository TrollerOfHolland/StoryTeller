<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserOwnedbook extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_ownedbook', function (Blueprint $table) {
            $table->bigInteger('userID')->unsigned();
            $table->bigInteger('bookID')->unsigned();
            $table->integer('actualPage');

            //Connection to user table
            $table->foreign('userID')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            //Connection to book table
            $table->foreign('bookID')
                ->references('id')
                ->on('book')
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
        Schema::dropIfExists('user_ownedbook');
    }
}
