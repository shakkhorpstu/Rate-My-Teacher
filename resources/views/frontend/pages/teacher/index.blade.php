@extends('frontend.layouts.master')

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-sm-8">
        <h3 style="margin-left: 50px"><b><i>Rate`My`Teachers</i></b></h3>
      </div>
    </div>

    <div class="row mt-10">
      @foreach($teachers as $teacher)
      <div class="col-md-3" style="margin-top: 10px">
        <div class="panel panel-primary" style="background-color: #007BA7">
          <div class="panel-body single-link" onclick="location.href='{!! route('teacherTakenCourse', $teacher->username) !!}'">
            <h4><b><font color="#FFF">{{ $teacher->first_name.' '.$teacher->last_name }}</font></b></h4>
            <h4><font color="#FFF">{{ \App\Models\CourseTeacher::where('teacher_id', $teacher->id)->count()." Course Taken Yet" }}</font></h4>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>


@endsection
