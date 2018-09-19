<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TotalReview extends Model
{
  public static function review($courseTeacherId, $year)
  {
    $courseTeachers = TotalReview::where('course_teacher_id', $courseTeacherId)->where('year', $year)->get();
    $totalGivenReview = count($courseTeachers);
    $totalReview = 0;
    if(count($courseTeachers) > 0){
      foreach ($courseTeachers as $courseTeacher) {
        $totalReview += $courseTeacher->rating;
      }
      $totalReview = @($totalReview / $totalGivenReview);
    	return $totalReview.'%';
    }
    else{
    	return 'No review yet';
    }
  }
}
