<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedInteger('user_id')->nullable();

            $table->integer('level');

            $table->unsignedInteger('period_id');
            $table->unsignedInteger('year');

            $table->time('schedule_start');
            $table->time('schedule_end');
            $table->text('days');

            $table->unsignedInteger('classroom_id')->nullable();
            $table->unsignedInteger('capacity')->default(40);

            $table->text('code');
            $table->text('name');

            $table->boolean('active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
    }
}
