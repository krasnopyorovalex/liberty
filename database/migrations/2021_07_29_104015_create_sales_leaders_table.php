<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesLeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_leaders', function (Blueprint $table) {
            $table->id();
            $table->string('name', 512);
            $table->string('title', 512);
            $table->string('description', 512);
            $table->text('text')->nullable();
            $table->string('alias', 64)->unique();
            $table->string('image', 128)->nullable();
            $table->string('image_mob', 128)->nullable();
            $table->enum('show_in_slider', [0,1])->default(1);
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
        Schema::dropIfExists('sales_leaders');
    }
}
