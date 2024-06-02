<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCoffeeshopIdToDrinksTable extends Migration
{
    public function up()
    {
        Schema::table('drinks', function (Blueprint $table) {
            $table->unsignedBigInteger('coffeeshop_id')->after('id')->nullable();
            $table->foreign('coffeeshop_id')->references('id')->on('coffeeshops')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('drinks', function (Blueprint $table) {
            $table->dropForeign(['coffeeshop_id']);
            $table->dropColumn('coffeeshops_id');
        });
    }
}
