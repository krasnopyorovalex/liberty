<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFurnitureHasAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('furniture_has_attributes', function (Blueprint $table) {
            $table->unsignedBigInteger('furniture_id');
            $table->unsignedBigInteger('furniture_attribute_id');
            $table->string('value');

            $table->index(['furniture_id', 'furniture_attribute_id'], 'idx_f_id_fa_id');

            $table->foreign('furniture_id', 'fk_f_id')->references('id')->on('furniture')->onDelete('cascade');
            $table->foreign('furniture_attribute_id', 'fk_fa_id')->references('id')->on('furniture_attributes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('furniture_has_attributes');
    }
}
