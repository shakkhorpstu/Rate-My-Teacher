@extends('backend.layouts.master')

@section('content')

<div class="app-title">
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.student.index') }}">Student</a></li>
    <li class="breadcrumb-item">Add</li>
  </ul>
</div>

@include('backend.partials.message')

<div class="card mt-4">
  <div class="card-header">Student Information</div>
  <div class="card-body form-body">
    <form action="{{ route('admin.student.store') }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="form-row">
        <div class="col-md-6 form-group">
          <label for="name">Name <span class="text-danger required">*</span></label>
          <input type="text" name="name" id="name" class="form-control" placeholder="Name" required>
        </div>
        <div class="col-md-6 form-group">
          <label for="faculty_id">Faculty <span class="text-danger required">*</span></label>
          <select class="form-control" name="faculty_id" id="faculty_id" required>
            <option value="">Select Faculty</option>
            @foreach ($faculties as $faculty)
            <option value="{{ $faculty->id }}">{{ $faculty->short_name }}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="form-row">
        <div class="col-md-6 form-group">
          <label for="phone">Phone <span class="text-danger required">*</span></label>
          <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone Number" required>
        </div>
        <div class="col-md-6 form-group">
          <label for="email">Email <span class="text-danger required">*</span></label>
          <input type="text" name="email" id="email" class="form-control" placeholder="Email Address" required>
        </div>
      </div>

      <div class="form-row">
        <div class="col-md-6 form-group">
          <label for="session">Session <span class="text-danger required">*</span></label>
          <input type="text" name="session" id="session" class="form-control" placeholder="Session" required>
        </div>
        <div class="col-md-3 form-group">
          <label for="level">Level <span class="text-danger required">*</span></label>
          <select class="form-control" name="level" id="level">
            <option value="">Select Level</option>
            <option value="1">Level - 1</option>
            <option value="2">Level - 2</option>
            <option value="3">Level - 3</option>
            <option value="4">Level - 4</option>
          </select>
        </div>
        <div class="col-md-3 form-group">
          <label for="semester">Semester <span class="text-danger required">*</span></label>
          <select class="form-control" name="semester" id="semester">
            <option value="">Select Semester</option>
            <option value="1">1st Semester</option>
            <option value="2">2nd Semester</option>
          </select>
        </div>
      </div>

      <button type="submit" class="btn btn-primary float-right">Add Student</button>
    </form>
  </div>
</div>

@endsection
