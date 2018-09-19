@extends('frontend.layouts.master')

@section('content')

  <div class="container">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel">
        <div class="panel panel-default">
          <div class="panel-body">

            @include('frontend.partials.message')

            <form class="" action="{{ route('registerStudent') }}" method="post">
              @csrf

              <div class="form-row">
                <div class="col-md-6 form-group">
                  <label for="name">Name</label>
                  <input type="text" name="name" id="name" class="form-control" placeholder="Student Name" value="" required>
                </div>

                <div class="col-md-6 form-group">
                  <label for="faculty_id">Faculty</label>
                  <select class="form-control" name="faculty_id" id="faculty_id" required>
                    <option value="">Select Faculty</option>
                    @foreach($faculties as $faculty)
                      <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-row">
                <div class="col-md-6 form-froup">
                  <label for="university_id">Student ID</label>
                  <input type="number" class="form-control" name="university_id" id="university_id" placeholder="eg. 1402018">
                </div>
                <div class="col-md-6 form-froup">
                  <label for="registration_no">Registration Number</label>
                  <input type="number" class="form-control" name="registration_no" id="registration_no" placeholder="eg. 05367">
                </div>
              </div>

              <div class="form-row">
                <div class="col-md-6 form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" id="email" class="form-control" placeholder="Student Email" value="" required>
                </div>

                <div class="col-md-6 form-group">
                  <label for="phone">Phone</label>
                  <input type="text" name="phone" id="phone" class="form-control" placeholder="Student Phone Number" value="" required>
                </div>
              </div>

              <div class="form-row">
                <div class="col-md-4 form-group">
                  <label for="session">Session</label>
                  <input type="text" name="session" id="session" class="form-control" placeholder="Student Session" value="" required>
                </div>

                <div class="col-md-4 form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" id="password" class="form-control" placeholder="Password" value="" required>
                </div>

                <div class="col-md-4 form-group">
                  <label for="confirm_password">Confirm Password</label>
                  <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password" value="" required>
                </div>
              </div>

              <button type="submit" class="btn btn-primary btn-lg">Register</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
