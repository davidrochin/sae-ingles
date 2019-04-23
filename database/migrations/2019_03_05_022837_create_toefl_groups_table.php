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
            $table->integer('capacity')->default(40);
            $table->unsignedInteger('classroom_id')->nullable();
            $table->boolean('applied')->default(true);
            $table->date('date');
            $table->time('time');

           // $table->time('hour');
           
        });

        Schema::create('student_toefl_group', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
             
            $table->unsignedInteger('student_id');
            $table->unsignedInteger('toefl_group_id');
            $table->integer('score')->nullable();
        });

        Schema::table('toefl_groups', function (Blueprint $table) {
            $table->foreign('responsable_user_id')->references('id')->on('users');
            $table->foreign('applicator_user_id')->references('id')->on('users');
        });

        Schema::table('student_toefl_group', function (Blueprint $table) {
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('toefl_group_id')->references('id')->on('toefl_groups');
        });
        
        Schema::table('toefl_groups', function(Blueprint $table){
            $table->foreign('classroom_id')->references('id')->on('classrooms');
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
