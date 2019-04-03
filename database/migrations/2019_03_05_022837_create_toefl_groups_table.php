<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToeflGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('toefl_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedInteger('responsable_user_id')->nullable();
            $table->unsignedInteger('applicator_user_id')->nullable();
            $table->unsignedInteger('capacity')->default(40);
            $table->boolean('applied')->default(true);

            $table->dateTime('date');
        });

        Schema::create('student_toefl_group', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
             
            $table->unsignedInteger('student_id');
            $table->unsignedInteger('toefl_group_id');
            $table->integer('score')->default(0);
        });

        Schema::table('toefl_groups', function (Blueprint $table) {
            $table->foreign('responsable_user_id')->references('id')->on('users');
            $table->foreign('applicator_user_id')->references('id')->on('users');
        });

        Schema::table('student_toefl_group', function (Blueprint $table) {
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('toefl_group_id')->references('id')->on('toefl_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_toefl_group');
        Schema::dropIfExists('toefl_groups');
    }
}
