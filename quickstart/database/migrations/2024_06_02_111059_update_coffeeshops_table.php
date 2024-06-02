<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCoffeeshopsTable extends Migration
{
    public function up()
    {
        Schema::table('coffeeshops', function (Blueprint $table) {
            $table->text('description')->nullable()->after('name');
            $table->string('address')->nullable()->change();
            $table->string('contact')->nullable()->change();
            $table->string('photo')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('coffeeshops', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->string('address')->change();
            $table->string('contact')->change();
            $table->string('photo')->change();
        });
    }
}
