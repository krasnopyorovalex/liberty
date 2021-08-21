<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('collection_id');
            $table->string('alt', 255)->nullable();
            $table->string('title', 255)->nullable();
            $table->text('text')->nullable();
            $table->char('basename', 40);
            $table->string('ext', 5);
            $table->enum('is_mobile',[0,1])->default(0);
            $table->unsignedSmallInteger('pos')->default(0);

            $table->index(['collection_id']);
            $table->foreign('collection_id')->references('id')->on('collections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collection_images');
    }
}
