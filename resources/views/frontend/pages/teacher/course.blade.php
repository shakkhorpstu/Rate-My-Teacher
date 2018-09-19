@extends('frontend.layouts.master')

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-sm-8">
        <h3 style="margin-left: 50px"><b><i>Rate`My`Teachers</i></b></h3>
      </div>
    </div>

    <div class="row mt-10">
      @foreach($courses as $course)
        <div class="col-md-4">
          <div class="panel panel-default mt-3" style="background-color: #007BA7">
            <div class="panel-body single-link" onclick="location.href='{!! route('teacherCourseReview', [$course->course->code, $teacher->username, $course->id, $course->year]) !!}'">
              <h4><b><font color="#FFF">{{ $course->course->code }}</font></b></h4>
              <h4><font color="#FFF">{{ $course->course->title }}</font></h4>
              <h4><font color="#FFF">{{ "Course Taken On ".$course->year }}</font></h4>
              <h4><font color="#FFF">{{ "Performance:  ".\App\Models\TotalReview::review($course->id, $course->year) }}</font></h4>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>


@endsection
