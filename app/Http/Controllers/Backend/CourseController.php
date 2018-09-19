<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Course;
use Session;

class CourseController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:admin');
  }

  /**
  * [show all course to backend.pages.course.index page including all faculty & department for add & update course]
  */
  public function index()
  {
    $departments =  Department::orderBy('id', 'DESC')->get();
    $faculties = Faculty::orderBy('id', 'DESC')->get();
    $courses = Course::orderBy('id', 'DESC')->get();
    return view('backend.pages.course.index', compact('departments', 'faculties', 'courses'));
  }


  /**
  * store all the information of form to the database
  */
  public function store(Request $request)
  {
    $course = new Course();

    $this->validate($request, [
      'code' => 'required|unique:courses',
      'title' => 'required|unique:courses',
      'faculty_id' => 'required',
      'department_id' => 'required',
    ]);

    $course->code = $request->code;
    $course->title = $request->title;
    $course->faculty_id = $request->faculty_id;
    $course->department_id = $request->department_id;
    $course->save();

    session()->flash('success', 'Course added successfully');
    return redirect()->route('admin.course.index');
  }


  /**
  * update all the information of form to the database
  */
  public function update(Request $request, $id)
  {
    $course = Course::find($id);

    $this->validate($request, [
      'code' => 'required|unique:courses,code,'.$course->id,
      'title' => 'required|unique:courses,title,'.$course->id,
      'faculty_id' => 'required',
      'department_id' => 'required',
    ]);

    $course->code = $request->code;
    $course->title = $request->title;
    $course->faculty_id = $request->faculty_id;
    $course->department_id = $request->department_id;
    $course->save();

    session()->flash('success', 'Course updated successfully');
    return redirect()->route('admin.course.index');
  }


  /**
  * delete course from the database
  */
  public function destroy($id)
  {
    Course::find($id)->delete();
    session()->flash('error', 'Course deleted successfully');
    return redirect()->route('admin.course.index');
  }
}
