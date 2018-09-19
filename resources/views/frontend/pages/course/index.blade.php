@extends('frontend.layouts.master')

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-sm-8">
        <h3 style="margin-left: 50px"><b><i>Rate`My`Teachers</i></b></h3>
      </div>
    </div>

    <div class="row mt-10">
      <h3><i>Courses Of {{ $department->name }}</i></h3>
      @foreach($courses as $course)
        <div class="col-md-4">
          <div class="panel panel-default mt-3" style="background-color: #004225">
            <div class="panel-body single-link" onclick="location.href='{!! route('courseTeacher', $course->code) !!}'">
              <h3><b><font color="#FFF">{{ $course->code }}</font></b></h3>
              <h4><font color="#FFF">{{ $course->title }}</font></h4>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>


@endsection
