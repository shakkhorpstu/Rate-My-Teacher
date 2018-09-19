<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewQuestionAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_question_answers', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('student_id');
          $table->unsignedInteger('course_teacher_id');
          $table->unsignedInteger('teacher_id');
          $table->unsignedInteger('question_id');
          $table->tinyInteger('rating');
          $table->timestamps();

          $table->foreign('student_id')->references('id')->on('students');
          $table->foreign('course_teacher_id')->references('id')->on('course_teachers');
          $table->foreign('teacher_id')->references('id')->on('teachers');
          $table->foreign('question_id')->references('id')->on('review_questions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review_question_answers');
    }
}
