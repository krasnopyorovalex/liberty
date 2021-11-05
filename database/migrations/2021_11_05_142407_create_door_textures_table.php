<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoorTexturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('door_textures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('door_id');
            $table->string('path', 255);
            $table->string('label', 16)->nullable();

            $table->index(['door_id']);
            $table->foreign('door_id')->references('id')->on('doors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('door_textures');
    }
}
