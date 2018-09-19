<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Helpers\ImageUploadHelper;
use App\Models\Student;
use App\Models\Faculty;
use Session;
use Auth;
use File;
use Excel;

class StudentController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:admin');
  }

  /**
  * [show all students to backend.pages.student.index page including all faculty for add & update student]
  */
  public function index()
  {
    $faculties = Faculty::orderBy('id', 'DESC')->get();
    $students = Student::orderBy('id', 'DESC')->get();
    return view('backend.pages.student.index', compact('faculties', 'students'));
  }


  public function create()
  {
    $faculties = Faculty::orderBy('id', 'DESC')->get();
    return view('backend.pages.student.create', compact('faculties'));
  }


  /**
  * store all the information of form to the database
  */
  public function store(Request $request)
  {
    $student = new Student();

    $this->validate($request, [
      'phone' => 'required',
      'email' => 'required',
      'faculty_id' => 'required',
      'session' => 'required',
      'semester' => 'required',
      'level' => 'required',
      'name' => 'required',
    ]);

    $student->phone = $request->phone;
    $student->email = $request->email;
    $student->faculty_id = $request->faculty_id;
    $student->session = $request->session;
    $student->level = $request->level;
    $student->semester = $request->semester;
    $student->name = $request->name;
    $student->save();

    session()->flash('success', 'Student added successfully');
    return redirect()->route('admin.student.index');
  }


  /**
  * update all the information of form to the database
  */
  public function update(Request $request, $id)
  {
    $student = Student::find($id);

    $this->validate($request, [
      'phone' => 'required',
      'email' => 'required',
      'faculty_id' => 'required',
      'session' => 'required',
      'semester' => 'required',
      'level' => 'required',
      'name' => 'required',
    ]);

    $student->phone = $request->phone;
    $student->email = $request->email;
    $student->faculty_id = $request->faculty_id;
    $student->session = $request->session;
    $student->level = $request->level;
    $student->semester = $request->semester;
    $student->name = $request->name;
    $student->save();

    session()->flash('success', 'Student updated successfully');
    return redirect()->route('admin.student.index');
  }


  /**
  * delete student from the database
  */
  public function destroy($id)
  {
    $student = Student::find($id);
    if($student->image){
      ImageUploadHelper::delete('public/image/teachers/'.$student->image);
    }
    $student->delete();
    session()->flash('error', 'Student deleted successfully');
    return redirect()->route('admin.student.index');
  }


  public function uploadExcel(Request $request)
  {
    $this->validate($request, [
      'file' => 'required'
    ]);

    $facultyName = Auth::guard('admin')->user()->faculty;
    $facultyInfo = Faculty::where('short_name', $facultyName)->first();
    $facultyId = $facultyInfo->id;

    if($request->hasFile('file')){
      $extension = File::extension($request->file->getClientOriginalName());
      if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {

        $path = $request->file->getRealPath();
        $data = Excel::load($path, function($reader) {
        })->get();

        if(!empty($data) && $data->count()){
          foreach ($data as $key => $value) {

            // check each excel column is fillable or not for each row
            if(!is_null($value->student_id) && !is_null($value->registration_no)){
                // keep this row value in a array
                $insert[] = [
                  'faculty_id' => $facultyId,
                  'university_id' => $value->student_id,
                  'registration_no' => $value->registration_no,
                ];
            }
          }
          //check array is empty or not
          if(!empty($insert)){
            // insert to courses table
            DB::table('students')->insert($insert);
            return back();
          }
        }
      }
      else {
        Session::flash('error', 'File is a '.$extension.' file.!! Please upload a valid xls/csv file..!!');
        return back();
      }
    }
  }


  public function upgradeSemester()
  {
    $facultyName = Auth::guard('admin')->user()->faculty;
    $facultyInfo = Faculty::where('short_name', $facultyName)->first();
    $facultyId = $facultyInfo->id;

    $students = Student::where('faculty_id', $facultyId)->get();
    foreach ($students as $student) {
      if($student->semester % 2 == 0){
        $student->semester = 1;
        $student->level = $student->level + 1;
      }
      else{
        $student->semester = 2;
      }
      $student->save();
    }
    session()->flash('success', 'Semester Upgrade successfully');
    return back();
  }
}
