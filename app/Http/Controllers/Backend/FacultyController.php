<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Faculty;
use Session;

class FacultyController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:admin');
  }

  /**
   * [show all faculty to backend.pages.faculty.index page]
   */
  public function index()
  {
    $faculties =  Faculty::orderBy('id', 'DESC')->get();
    return view('backend.pages.faculty.index', compact('faculties'));
  }


  /**
   * store all the information of form to the database
   */
  public function store(Request $request)
  {
    $faculty = new Faculty();

    $this->validate($request, [
      'name' => 'required|unique:faculties',
      'short_name' => 'required|unique:faculties',
    ]);

    $faculty->name = $request->name;
    $faculty->short_name = $request->short_name;
    $faculty->save();

    session()->flash('success', 'Faculty added successfully');
    return redirect()->route('admin.faculty.index');
  }


  /**
   * update all the information of form to the database
   */
  public function update(Request $request, $id)
  {
    $faculty = Faculty::find($id);

    $this->validate($request, [
      'name' => 'required|unique:faculties,name,'.$faculty->id,
      'short_name' => 'required|unique:faculties,short_name,'.$faculty->id,
    ]);

    $faculty->name = $request->name;
    $faculty->short_name = $request->short_name;
    $faculty->save();

    session()->flash('success', 'Faculty updated successfully');
    return redirect()->route('admin.faculty.index');
  }


  /**
   * delete faculty from the database
   */
  public function destroy($id)
  {
    Faculty::find($id)->delete();
    session()->flash('error', 'Department deleted successfully');
    return redirect()->route('admin.faculty.index');
  }
}
