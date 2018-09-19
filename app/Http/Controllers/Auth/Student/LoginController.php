<?php

namespace App\Http\Controllers\Auth\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Session;
use App\Models\Student;


class LoginController extends Controller
{

    use AuthenticatesUsers;


    protected $redirectTo = '/';

    public function __construct(){
        $this->middleware('guest:student', ['except' => ['logout']]);
    }


    public function showLoginForm(){
        return view('frontend.auth.login');
    }

    public function login(Request $request){

        //Validate the form data
        $this->validate($request, [
            'email' 		=> 'required',
            'password' 		=> 'required'
        ]);


        //Attempt to log the employee in
        if (Auth::guard('student')->attempt(['email' => $request->email, 'password' => $request->password, 'verify_token' => 1], $request->remember)) {
            $student = Student::where('email', $request->email)->first();
            if (!is_null($student)) {
                return redirect()->intended(route('index'));
            }
        }else{
            Session::flash('login_error', "Please Provide Correct Email & Password");
        }

        return redirect()->back()->withInput($request->only('email', 'remember'));
    }


    public function logout()
    {
        Auth::guard('student')->logout();
        return redirect()->route('index');
    }
}
