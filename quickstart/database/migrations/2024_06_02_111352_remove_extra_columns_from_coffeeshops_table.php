<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveExtraColumnsFromCoffeeshopsTable extends Migration
{
    public function up()
    {
        Schema::table('coffeeshops', function (Blueprint $table) {
            $table->dropColumn('hours');
        });
    }

    public function down()
    {
        Schema::table('coffeeshops', function (Blueprint $table) {
            $table->string('hours')->nullable();
        });
    }
}
