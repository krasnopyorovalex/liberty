<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('template', 24)->default('page.index');
            $table->string('name', 512);
            $table->string('title', 512);
            $table->string('description', 512);
            $table->text('text')->nullable();
            $table->string('sub_title', 512)->nullable();
            $table->string('alias', 64)->unique();
            $table->enum('is_published',[0,1])->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
