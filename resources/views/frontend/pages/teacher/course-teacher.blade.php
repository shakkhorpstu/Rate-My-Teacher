@extends('frontend.layouts.master')

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-sm-8">
        <h3 style="margin-left: 50px"><b><i>Rate`My`Teachers</i></b></h3>
      </div>
    </div>

    <div class="row mt-10">
      <h3><i>Teachers Of {{ $course->code }}</i></h3>
      @if(count($courseTeachers) > 0)
      @foreach($courseTeachers as $courseTeacher)
        <div class="col-md-4">
          <div class="panel panel-default mt-3" style="background-color: #004225">
            <div class="panel-body single-link" onclick="location.href='{!! route('courseTeacherReview', [$courseTeacher->teacher->username, $courseTeacher->year, $courseTeacher->id]) !!}'">
              <h4><b><font color="#FFF">{{ $courseTeacher->teacher->first_name.' '.$courseTeacher->teacher->last_name }}</font></b></h4>
              <h4><font color="#FFF">{{ "Department Of ".$courseTeacher->teacher->department->short_name }}</font></h4>
              <h4><font color="#FFF">{{ "Course Taken On ".$courseTeacher->year }}</font></h4>
              <h4><font color="#FFF">{{ "Overall Review  ".\App\Models\TotalReview::review($courseTeacher->id, $courseTeacher->year) }}</font></h4>
            </div>
          </div>
        </div>
      @endforeach
      @else
      <h2>No review yet for this teacher</h2>
      @endif
    </div>
  </div>


@endsection
