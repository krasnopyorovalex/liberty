<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('author_id')->nullable();
            $table->string('name', 512);
            $table->string('title', 512);
            $table->string('description', 512);
            $table->string('alias', 64)->unique();
            $table->string('image', 128)->nullable();
            $table->string('image_mob', 128)->nullable();
            $table->string('file', 128)->nullable();
            $table->text('text')->nullable();
            $table->json('finishing_options')->nullable();
            $table->json('finishing_option_names')->nullable();
            $table->timestamps();

            $table->index(['parent_id', 'author_id']);
            $table->foreign('parent_id')->references('id')->on('doors')->onDelete('set null');
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doors');
    }
}
