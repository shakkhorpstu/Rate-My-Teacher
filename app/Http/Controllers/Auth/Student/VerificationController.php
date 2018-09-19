<?php

namespace App\Http\Controllers\Auth\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Teacher;
use Session;

class VerificationController extends Controller
{
    public function verify($token="")
    {
      //Search in student database if there is any student by this token.
      $teacher = Teacher::where('verify_token', $token)->first();
  		if (!is_null($teacher)) {
  			if ($teacher->status) {
  				Session::flash('already_added', 'Teacher has already verified !! Please Login');
  			}else {
  				$teacher->status = 1;
  				$teacher->verify_token = null;
  				$teacher->save();
  				Session::flash('success', 'Student Account has verified successfully!! You can Login Now');
  			}
  		}else {
  			Session::flash('error', 'Invalid Token !! Please verify with correct token. Click send verification link again ');
  		}
  		return view('frontend.auth.teachers.verify')->withToken($token)->withTeacher($teacher);
    }

    public function verification_page($teacher_id, $token)
    {
      //Search in student database if there is any student by this token.
      $teacher = Teacher::find($teacher_id);
  		return view('frontend.auth.teachers.verification')->withToken($token)->withTeacher($teacher);
    }
}
