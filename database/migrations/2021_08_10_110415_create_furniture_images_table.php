<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFurnitureImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('furniture_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('furniture_id');
            $table->string('alt', 255)->nullable();
            $table->string('title', 255)->nullable();
            $table->text('text')->nullable();
            $table->char('basename', 40);
            $table->string('ext', 5);
            $table->enum('is_mobile',[0,1])->default(0);
            $table->unsignedSmallInteger('pos')->default(0);

            $table->index(['furniture_id']);
            $table->foreign('furniture_id')->references('id')->on('furniture')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('furniture_images');
    }
}
