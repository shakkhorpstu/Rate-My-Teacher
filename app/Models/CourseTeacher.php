<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TotalReview;

class CourseTeacher extends Model
{
  public function course()
  {
    return $this->belongsTo(Course::class);
  }

  public function teacher()
  {
    return $this->belongsTo(Teacher::class);
  }

  // public static function reviewTeacher($courseTeacherId, $year)
  // {
  //   $reviews = TotalReview::where('course_teacher_id', $courseTeacherId)->where('year', $year)->get();
  //   $totalReview = 0;
  //   $totalGivenReview = count($reviews);
  //   if($reviews != null){
  //     foreach($reviews as $review){
  //       $totalReview += $review->rating;
  //     }
  //     $totalReview = @($totalReview / $totalGivenReview);
  //     return $totalReview.'%';
  //   }
  //   else{
  //     return "No review";
  //   }
  // }
}
