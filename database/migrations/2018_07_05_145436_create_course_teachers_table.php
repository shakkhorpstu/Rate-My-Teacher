<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_teachers', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('course_id');
          $table->unsignedInteger('teacher_id');
          $table->unsignedInteger('year');
          $table->timestamps();

          $table->foreign('course_id')->references('id')->on('courses');
          $table->foreign('teacher_id')->references('id')->on('teachers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_teachers');
    }
}
