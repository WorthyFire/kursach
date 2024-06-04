<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveDrinkIdFromReviewsTable extends Migration
{
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['drink_id']);
            $table->dropColumn('drink_id');
        });
    }

    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->unsignedBigInteger('drink_id')->nullable();
            $table->foreign('drink_id')->references('id')->on('drinks')->onDelete('cascade');
        });
    }
}
