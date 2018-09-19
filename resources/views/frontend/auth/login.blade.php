@extends('frontend.layouts.master')

@section('content')
  <div class="container">
    <div class="col-md-6 col-md-offset-3">

      <div class="panel">
        <div class="panel panel-default">
          @include('frontend.partials.message')

          <form class="form-signin pt-5" method="POST" action="{{ route('student.login.submit') }}">
            @csrf
            <h2 class="form-signin-heading"><i>Student Login</i></h2>

            @if ( Session::has('login_error') )
              <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {!! Session::get('login_error') !!}
              </div>
            @endif

            <div class="form-group">
              <label for="inputEmail">Email address</label>
              <input type="email" id="inputEmail" class="form-control" placeholder="Email address"  name="email" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="form-group mt-2">
              <label for="inputPassword">Password</label>
              <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
            </div>

            <div class="checkbox">
              <label>
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
              </label>
            </div>

            <div class="form-group">
              <div class="col-md-6">
                <button type="submit" class="btn btn-lg btn-primary btn-block">
                  <i class="fa fa-btn fa-sign-in"></i> Login
                </button>

                <a class="btn btn-link" href="{{ route('student.password.request') }}">Forgot Your Password?</a>
              </div>
            </div>
            <div class="clearfix"></div>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection
