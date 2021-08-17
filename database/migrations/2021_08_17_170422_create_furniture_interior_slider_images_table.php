<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFurnitureInteriorSliderImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('furniture_interior_slider_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('furniture_interior_slider_id');
            $table->string('name', 255)->nullable();
            $table->string('link', 127)->nullable();
            $table->string('alt', 255)->nullable();
            $table->string('title', 255)->nullable();
            $table->text('text')->nullable();
            $table->char('basename', 40);
            $table->string('ext', 5);
            $table->enum('is_mobile',[0,1])->default(0);
            $table->unsignedSmallInteger('pos')->default(0);

            $table->index(['furniture_interior_slider_id'], 'idx_fis_id');
            $table->foreign('furniture_interior_slider_id', 'fk_fis_id')->references('id')->on('furniture_interior_sliders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('furniture_interior_slider_images');
    }
}
