<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Faculty;
use Session;

class DepartmentController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:admin');
  }

  /**
  * [show all department to backend.pages.department.index page]
  */
  public function index()
  {
    $departments =  Department::orderBy('id', 'DESC')->get();
    $faculties = Faculty::orderBy('id', 'DESC')->get();
    return view('backend.pages.department.index', compact('departments', 'faculties'));
  }


  /**
  * store all the information of form to the database
  */
  public function store(Request $request)
  {
    $department = new Department();

    $this->validate($request, [
      'name' => 'required|unique:departments',
      'short_name' => 'required|unique:departments',
    ]);

    $department->name = $request->name;
    $department->short_name = $request->short_name;
  $department->faculty_id = $request->faculty_id;
    $department->save();

    session()->flash('success', 'Department added successfully');
    return redirect()->route('admin.department.index');
  }


  /**
  * update all the information of form to the database
  */
  public function update(Request $request, $id)
  {
    $department = Department::find($id);

    $this->validate($request, [
      'name' => 'required|unique:departments,name,'.$department->id,
      'short_name' => 'required|unique:departments,short_name,'.$department->id,
    ]);

    $department->name = $request->name;
    $department->short_name = $request->short_name;
  $department->faculty_id = $request->faculty_id;
    $department->save();

    session()->flash('success', 'Department updated successfully');
    return redirect()->route('admin.department.index');
  }


  /**
  * delete department from the database
  */
  public function destroy($id)
  {
    Department::find($id)->delete();
    session()->flash('error', 'Department deleted successfully');
    return redirect()->route('admin.department.index');
  }
}
