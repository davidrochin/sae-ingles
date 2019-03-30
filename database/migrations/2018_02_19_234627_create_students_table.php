<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->text('control_number');

            $table->unsignedInteger('career_id')->nullable();

            $table->text('first_names');
            $table->text('last_names');

            $table->text('phone_number')->nullable();
            $table->text('email')->nullable();


            $table->boolean('active')->default(true);

            //$table->boolean('active')->default(true);

            //Faltan otros datos

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
