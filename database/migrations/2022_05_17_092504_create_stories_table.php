<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Node;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->boolean('ageLimit');
            $table->float('rating')->default(0);
            $table->integer('numOfRates')->default(0);
            $table->string('coverPhoto')->nullable();
            $table->boolean('disable_comments')->default(false);
            $table->boolean('disable_ratings')->default(false);
            $table->unsignedBigInteger("creator_id")->nullable();
            $table->timestamps();

            $table->foreign('creator_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stories');
    }
};
