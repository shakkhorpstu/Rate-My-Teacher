<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\ImageUploadHelper;
use App\Helpers\StringHelper;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Teacher;
use Session;

class TeacherController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:admin');
  }

  /**
  * [show all teacher to backend.pages.teacher.index page including all faculty & department for add & update teacher]
  */
  public function index()
  {
    $departments =  Department::orderBy('id', 'DESC')->get();
    $faculties = Faculty::orderBy('id', 'DESC')->get();
    $teachers = Teacher::orderBy('id', 'DESC')->get();
    return view('backend.pages.teacher.index', compact('departments', 'faculties', 'teachers'));
  }


  /**
  * store all the information of form to the database
  */
  public function store(Request $request)
  {
    $teacher = new Teacher();

    $this->validate($request, [
      'phone' => 'required|unique:teachers',
      'email' => 'required|unique:teachers',
      'faculty_id' => 'required',
      'department_id' => 'required',
      'first_name' => 'required',
    ]);

    $teacher->phone = $request->phone;
    $teacher->email = $request->email;
    $teacher->faculty_id = $request->faculty_id;
    $teacher->department_id = $request->department_id;
    $teacher->first_name = $request->first_name;
    $teacher->last_name = $request->last_name;
    $teacher->image = ImageUploadHelper::upload('image', $request->file('image'), time(), 'public/image/teachers');
    $teacher->username = StringHelper::createSlug($request->first_name, 'Teacher', 'username');
    $teacher->save();

    session()->flash('success', 'Teacher added successfully');
    return redirect()->route('admin.teacher.index');
  }


  /**
  * update all the information of form to the database
  */
  public function update(Request $request, $id)
  {
    $teacher = Teacher::find($id);

    $this->validate($request, [
      'phone' => 'required|unique:teachers,phone,'.$teacher->id,
      'email' => 'required|unique:teachers,email,'.$teacher->id,
      'faculty_id' => 'required',
      'department_id' => 'required',
      'first_name' => 'required',
    ]);

    $teacher->phone = $request->phone;
    $teacher->email = $request->email;
    $teacher->faculty_id = $request->faculty_id;
    $teacher->department_id = $request->department_id;
    $teacher->first_name = $request->first_name;
    $teacher->last_name = $request->last_name;
    if(!is_null($request->image)){
      if(!is_null($teacher->image)){
        $teacher->image = ImageUploadHelper::update('image', $request->file('image'), time(), 'public/image/teachers', $teacher->image);
      }
      else{
        $teacher->image = ImageUploadHelper::upload('image', $request->file('image'), time(), 'public/image/teachers');
      }
    }
    $teacher->username = StringHelper::createSlug($request->first_name, 'Teacher', 'username');
    $teacher->save();

    session()->flash('success', 'Teacher updated successfully');
    return redirect()->route('admin.teacher.index');
  }


  /**
  * delete teacher from the database
  */
  public function destroy($id)
  {
    $teacher = Teacher::find($id);
    if($teacher->image){
      ImageUploadHelper::delete('public/image/teachers/'.$teacher->image);
    }
    $teacher->delete();
    session()->flash('error', 'Teacher deleted successfully');
    return redirect()->route('admin.teacher.index');
  }
}
