<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Course;

class PagesController extends Controller
{
  public function index()
  {
    $departments = Department::orderBy('name', 'ASC')->get();
    return view('frontend.pages.index', compact('departments'));
  }

  public function departmentCourse($shortName)
  {
    $department = Department::where('short_name', $shortName)->first();
    $courses = Course::where('department_id', $department->id)->get();
    return view('frontend.pages.course.index', compact('courses', 'department'));
  }
}
