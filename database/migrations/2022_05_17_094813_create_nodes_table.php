<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nodes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('story_id');
            $table->longText('content')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('option_one_id')->nullable();
            $table->string('option_one_text')->nullable();
            $table->unsignedBigInteger('option_two_id')->nullable();
            $table->string('option_two_text')->nullable();
            $table->unsignedBigInteger('option_three_id')->nullable();
            $table->string('option_three_text')->nullable();
            $table->boolean('end')->default(false);
            $table->boolean('fixpoint')->default(false);

            $table->timestamps();

            $table->foreign('story_id')->references('id')->on('stories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('parent_id')->references('id')->on('nodes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('option_one_id')->references('id')->on('nodes');
            $table->foreign('option_two_id')->references('id')->on('nodes');
            $table->foreign('option_three_id')->references('id')->on('nodes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nodes');
    }
};
