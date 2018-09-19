<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ReviewQuestionAnswer;

class ReviewQuestionAnswer extends Model
{
  public function question()
  {
    return $this->belongsTo(ReviewQuestion::class);
  }

  public function student()
  {
    return $this->belongsTo(Student::class);
  }

  public static function countThisAnswer($courseTeacherId, $teacherId, $year, $questionId)
  {
    $thisAnswers = ReviewQuestionAnswer::where('course_teacher_id', $courseTeacherId)
    ->where('teacher_id', $teacherId)
    ->where('year', $year)
    ->where('question_id', $questionId)
    ->get();

    if(count($thisAnswers) > 0){
      $thisRating = 0;
      foreach ($thisAnswers as $thisAnswer) {
        $thisRating += $thisAnswer->rating;
      }
      $thisAnswerPercentage = (($thisRating * 100) / (5 * count($thisAnswers)));
      return $thisAnswerPercentage.'%';
    }
    else{
      return 'No Review yet';
    }
  }
}
