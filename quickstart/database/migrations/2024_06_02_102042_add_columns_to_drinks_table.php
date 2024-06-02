<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToDrinksTable extends Migration
{
    public function up()
    {
        Schema::table('drinks', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->text('ingredients')->after('name');
            $table->string('category')->after('ingredients');
            $table->string('photo')->nullable()->after('category');
            $table->text('description')->nullable()->after('photo');
        });
    }

    public function down()
    {
        Schema::table('drinks', function (Blueprint $table) {
            $table->dropColumn(['name', 'ingredients', 'category', 'photo', 'description']);
        });
    }
}
