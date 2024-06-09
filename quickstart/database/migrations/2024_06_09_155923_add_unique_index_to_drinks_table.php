<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUniqueIndexToDrinksTable extends Migration
{
    public function up()
    {
        Schema::table('drinks', function (Blueprint $table) {
            $table->unique(['name', 'coffeeshop_id']);
        });
    }

    public function down()
    {
        Schema::table('drinks', function (Blueprint $table) {
            $table->dropUnique(['name', 'coffeeshop_id']);
        });
    }
}

