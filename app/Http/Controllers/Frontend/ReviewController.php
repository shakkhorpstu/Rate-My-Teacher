<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CourseTeacher;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\ReviewQuestionAnswer;
use App\Models\TotalReview;
use Auth;

class ReviewController extends Controller
{
  public function review($userName, $year, $courseTeacherId)
  {
    $teacher = Teacher::where('username', $userName)->first();
    $courseTeacher = CourseTeacher::where('id', $courseTeacherId)->first();

    $courseId = $courseTeacher->course_id;
    $course = Course::where('id', $courseId)->first();

    $courseExplode = explode("-", $course->code);
    $courseCodeSplit = str_split($courseExplode[1], 1);
    $level = $courseCodeSplit[0];
    $semester = $courseCodeSplit[1];

    $reviews = ReviewQuestionAnswer::where('teacher_id', $teacher->id)->where('year', $year)->where('course_teacher_id', $courseTeacherId)->get();

    return view('frontend.pages.review.answer', compact('reviews', 'teacher', 'courseTeacherId', 'courseId', 'level', 'semester', 'year'));
  }


  public function teacherReview($courseCode, $userName, $courseTeacherId, $year)
  {
    $teacher = Teacher::where('username', $userName)->first();
    $course = Course::where('code', $courseCode)->first();
    $courseId = $course->id;

    $courseExplode = explode("-", $courseCode);
    $courseCodeSplit = str_split($courseExplode[1], 1);
    $level = $courseCodeSplit[0];
    $semester = $courseCodeSplit[1];

    $reviews = ReviewQuestionAnswer::where('teacher_id', $teacher->id)->where('course_teacher_id', $courseTeacherId)->get();
    return view('frontend.pages.review.answer', compact('reviews', 'teacher', 'courseTeacherId', 'courseId', 'level', 'semester', 'year'));
  }


  public function submitReview(Request $request)
  {
    if(Auth::guard('student')->check()){
      $alreadyReviewed = TotalReview::where('student_id', Auth::guard('student')->user()->id)
      ->where('course_teacher_id', $request->courseTeacherId)
      ->where('teacher_id', $request->teacherId)
      ->where('year', date('Y'))
      ->first();

      if($alreadyReviewed == null){
        $totalQuestions = $request->totalQuestion;
        $answers = array();
        for($totalQuestion = 1; $totalQuestion <= $totalQuestions; $totalQuestion++) {
          $string = 'answer';
          $numberString = (string) $totalQuestion;
          $requestVariable = $string.''.$numberString;
          $thisQuestionAnswer = $request->$requestVariable;
          if($thisQuestionAnswer == null){
            session()->flash('error', 'Please fill all the questions');
            return back();
          }
          else{
            array_push($answers, $thisQuestionAnswer);
          }
        }

        $questionIds = array();
        foreach($request->question_ids as $id){
          array_push($questionIds, $id);
        }

        $i = 0;
        $totalQuestion = count($questionIds);
        $totalAnswerMark = 0;

        for($questionId = 0; $questionId <= count($questionIds); $questionId++) {
          if($questionId == $totalQuestion){
            break;      }
            else{
              $reviewQuestionAnswer = new ReviewQuestionAnswer();
              $reviewQuestionAnswer->student_id = Auth::guard('student')->user()->id;
              $reviewQuestionAnswer->teacher_id = $request->teacherId;
              $reviewQuestionAnswer->course_teacher_id = $request->courseTeacherId;
              $reviewQuestionAnswer->question_id = $questionIds[$questionId];
              $reviewQuestionAnswer->rating = $answers[$questionId];
              $reviewQuestionAnswer->year = date('Y');
              $reviewQuestionAnswer->save();

              $totalAnswerMark += $answers[$questionId];
            }
          }

          $totalGainedMark = (($totalAnswerMark * 100) / ($totalQuestion * 5));
          $totalReview = new TotalReview();
          $totalReview->teacher_id = $request->teacherId;
          $totalReview->course_teacher_id = $request->courseTeacherId;
          $totalReview->student_id = Auth::guard('student')->user()->id;
          $totalReview->year = date('Y');
          $totalReview->rating = $totalGainedMark;
          $totalReview->save();

          session()->flash('success', 'Review submited successfully');
          return back();
        }
        else{
          session()->flash('error', 'Already Submitted');
          return back();
        }
      }
      else{
        return redirect(route('student.login'));
      }
    }
  }
