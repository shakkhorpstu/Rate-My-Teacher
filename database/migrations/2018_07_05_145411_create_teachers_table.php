<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
          $table->increments('id');
          $table->string('first_name');
          $table->string('last_name')->nulable();
          $table->string('phone')->unique();
          $table->string('email')->unique();
          $table->unsignedInteger('faculty_id');
          $table->unsignedInteger('department_id');
          $table->timestamps();

          $table->foreign('faculty_id')->references('id')->on('faculties');
          $table->foreign('department_id')->references('id')->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers');
    }
}
