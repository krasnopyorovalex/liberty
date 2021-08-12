<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoorHasAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('door_has_attributes', function (Blueprint $table) {
            $table->unsignedBigInteger('door_id');
            $table->unsignedBigInteger('door_attribute_id');
            $table->string('value');

            $table->index(['door_id', 'door_attribute_id'], 'idx_d_id_da_id');

            $table->foreign('door_id')->references('id')->on('doors')->onDelete('cascade');
            $table->foreign('door_attribute_id', 'fk_da_id')->references('id')->on('door_attributes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('door_has_attributes');
    }
}
