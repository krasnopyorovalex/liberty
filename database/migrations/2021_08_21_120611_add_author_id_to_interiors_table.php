<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAuthorIdToInteriorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('interiors', function (Blueprint $table) {
            $table->unsignedBigInteger('author_id')->nullable()->after('interior_type_id');

            $table->index(['author_id']);
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
        Schema::table('interiors', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
            $table->dropColumn(['author_id']);
        });
    }
}
