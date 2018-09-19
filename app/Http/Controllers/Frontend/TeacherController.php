<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CourseTeacher;
use App\Models\Course;
use App\Models\Teacher;

class TeacherController extends Controller
{
  public function index()
  {
    $teachers = Teacher::orderBy('id', 'DESC')->paginate(20);
    return view('frontend.pages.teacher.index', compact('teachers'));
  }

  public function courseTeacher($courseCode)
  {
    $course = Course::where('code', $courseCode)->first();
    $courseTeachers = CourseTeacher::where('course_id', $course->id)->get();
   
    if(count($courseTeachers) == 0){
      $courseTeachers = array();
    }
    return view('frontend.pages.teacher.course-teacher', compact('courseTeachers', 'course'));
  }

  public function teacherTakenCourse($userName)
  {
    $teacher = Teacher::where('username', $userName)->first();
    $courses = CourseTeacher::where('teacher_id', $teacher->id)->get();
    return view('frontend.pages.teacher.course', compact('courses', 'teacher'));
  }
}
