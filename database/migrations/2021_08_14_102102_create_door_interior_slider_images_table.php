<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoorInteriorSliderImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('door_interior_slider_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('door_interior_slider_id');
            $table->string('name', 255)->nullable();
            $table->string('link', 127)->nullable();
            $table->string('alt', 255)->nullable();
            $table->string('title', 255)->nullable();
            $table->text('text')->nullable();
            $table->char('basename', 40);
            $table->string('ext', 5);
            $table->enum('is_mobile',[0,1])->default(0);
            $table->unsignedSmallInteger('pos')->default(0);

            $table->index(['door_interior_slider_id']);
            $table->foreign('door_interior_slider_id', 'fk_dis_id')->references('id')->on('door_interior_sliders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('door_interior_slider_images');
    }
}
