<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoorInteriorSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('door_interior_sliders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('door_id');
            $table->string('name', 255);

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
        Schema::dropIfExists('door_interior_sliders');
    }
}
