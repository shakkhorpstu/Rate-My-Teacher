<?php

namespace App\Http\Controllers\Auth\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Notifications\AccountConfirmation;
use Illuminate\Http\Request;
use App\Models\Faculty;
use App\Models\Student;
use Session;
use Hash;

class RegisterController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Register Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles the registration of new users as well as their
  | validation and creation. By default this controller uses a trait to
  | provide this functionality without requiring any additional code.
  |
  */

  use RegistersUsers;

  /**
  * Where to redirect users after registration.
  *
  * @var string
  */
  protected $redirectTo = '/';

  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct()
  {
    $this->middleware('guest');
  }

  /**
  * Show the application registration form.
  *
  * @return \Illuminate\Http\Response
  */
  public function showRegistrationForm()
  {
    $faculties = Faculty::orderBy('name', 'asc')->get();
    return view('frontend.auth.register', compact('faculties'));
  }

  public function register(Request $request)
  {
    $this->validate($request, [
      'name' => 'required',
      'email' => 'required|unique:students',
      'phone' => 'required',
      'faculty_id' => 'required',
      'session' => 'required',
      'university_id' => 'required',
      'registration_no' => 'required',
      'password' => 'required',
      'confirm_password' => 'required',
    ]);

    $isStudent = Student::where('university_id', $request->university_id)
    ->where('registration_no', $request->registration_no)
    ->where('verify_token', 0)
    ->first();

    if($isStudent){
      if($request->password == $request->confirm_password){
        $student = Student::find($isStudent->id);
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->faculty_id = $request->faculty_id;
        $student->session = $request->session;
        $student->verify_token = str_random(16);
        $student->password = Hash::make($request->password);
        $student->save();

        $student->notify(new AccountConfirmation($student));

        session()->flash('success', "Your Account Created Successfully. Please first verify your email to login");
        return redirect()->route('student.login');
      }
      else{
        session()->flash('error', "Confirm Password Doesn't match");
        return back();
      }
    }
    else{
      session()->flash('error', "Sorry!!! you are not student of this university.");
      return back();
    }
  }


  public function confirmAccount($verifyToken)
  {
    Student::where('verify_token', $verifyToken)->update(['verify_token' => 1]);
    return redirect(route('student.login'));
  }
}
