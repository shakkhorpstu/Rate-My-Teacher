@extends('backend.layouts.master')

@section('content')

  <div class="app-title">
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ul>
  </div>

  @include('backend.partials.message')

  <div class="row">
    <div class="col-md-4 mt-2">
      <div class="card single-link" onclick="location.href='{!! route('admin.courseTeacher.index') !!}'">
        <div class="card-body">
          <h4 class="card-title">{{ \App\Models\CourseTeacher::count() }} Course Teacher</h4>
        </div>
      </div>
    </div>
    <div class="col-md-4 mt-2">
      <div class="card single-link" onclick="location.href='{!! route('admin.course.index') !!}'">
        <div class="card-body">
          <h4 class="card-title">{{ \App\Models\Course::count() }} Course</h4>
        </div>
      </div>
    </div>
  </div>
@endsection
