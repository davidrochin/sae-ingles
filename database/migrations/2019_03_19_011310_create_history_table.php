<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryTable extends Migration {

    public function up() {
        Schema::create('history', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('user_id');
            $table->longText('description');
        });

        Schema::table('history', function(Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down() {
        Schema::dropIfExists('history');
    }
}
