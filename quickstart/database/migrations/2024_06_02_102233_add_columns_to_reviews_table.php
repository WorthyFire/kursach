<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToReviewsTable extends Migration
{
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('id');
            $table->unsignedBigInteger('coffeeshop_id')->after('user_id');
            $table->unsignedBigInteger('drink_id')->after('coffeeshop_id');
            $table->integer('rating')->after('drink_id');
            $table->text('comment')->after('rating');

            // Добавление внешних ключей
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('coffeeshop_id')->references('id')->on('coffeeshops')->onDelete('cascade');
            $table->foreign('drink_id')->references('id')->on('drinks')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['coffeeshop_id']);
            $table->dropForeign(['drink_id']);
            $table->dropColumn(['user_id', 'coffeeshop_id', 'drink_id', 'rating', 'comment']);
        });
    }
}
