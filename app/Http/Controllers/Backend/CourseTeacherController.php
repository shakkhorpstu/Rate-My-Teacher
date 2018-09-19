<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\CourseTeacher;
use Session;

class CourseTeacherController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:admin');
  }

  /**
  * [show all course teachers to backend.pages.course-teacher.index page including all teachers & courses for add & update course teacher]
  */
  public function index()
  {
    $courses =  Course::orderBy('id', 'DESC')->get();
    $teachers = Teacher::orderBy('id', 'DESC')->get();
    $courseTeachers = CourseTeacher::orderBy('id', 'DESC')->get();
    return view('backend.pages.course-teacher.index', compact('teachers', 'courses', 'courseTeachers'));
  }


  /**
  * store all the information of form to the database
  */
  public function store(Request $request)
  {
    $courseTeacher = new CourseTeacher();

    $this->validate($request, [
      'course_id' => 'required',
      'teacher_id' => 'required',
    ]);

    $courseTeacher->course_id = $request->course_id;
    $courseTeacher->teacher_id = $request->teacher_id;
    $courseTeacher->year =  date('Y');
    $courseTeacher->save();

    session()->flash('success', 'Course Teacher added successfully');
    return redirect()->route('admin.courseTeacher.index');
  }


  /**
  * update all the information of form to the database
  */
  public function update(Request $request, $id)
  {
    $courseTeacher = CourseTeacher::find($id);

    $this->validate($request, [
      'course_id' => 'required',
      'teacher_id' => 'required',
    ]);

    $courseTeacher->course_id = $request->course_id;
    $courseTeacher->teacher_id = $request->teacher_id;
    $courseTeacher->year =  date('Y');
    $courseTeacher->save();

    session()->flash('success', 'Course updated successfully');
    return redirect()->route('admin.courseTeacher.index');
  }


  /**
  * delete course teacher from the database
  */
  public function destroy($id)
  {
    CourseTeacher::find($id)->delete();
    session()->flash('error', 'Course Teacher deleted successfully');
    return redirect()->route('admin.courseTeacher.index');
  }
}
