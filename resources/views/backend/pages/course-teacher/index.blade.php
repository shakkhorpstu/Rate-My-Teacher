@extends('backend.layouts.master')

@section('content')

  <div class="app-title">
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
      <li class="breadcrumb-item active">Course Teacher</li>
    </ul>
  </div>

  @include('backend.partials.message')

  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="card">
          <div class="card-header">
            <i class="fa fa-table"></i> <span class="ml-2">Course Teachers Of PSTU</span>
            <button class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#addModal">Add Course Teacher</button>
          </div>
        </div>
        <div class="tile-body mt-4">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th>Course Code</th>
                <th>Course Title</th>
                <th>Teacher</th>
                <th>Course Year</th>
                <th>Manage</th>
              </tr>
            </thead>
            <tbody>
              @if(!empty($courseTeachers))
                @foreach($courseTeachers as $courseTeacher)
                  <tr>
                    <td>{{ $courseTeacher->course->code }}</td>
                    <td>{{ $courseTeacher->course->title }}</td>
                    <td>{{ $courseTeacher->teacher->first_name.' '.$courseTeacher->teacher->last_name }}</td>
                    <td>{{ $courseTeacher->year }}</td>
                    <td>
                      <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal{{ $courseTeacher->id }}"><i class="fa fa-fw fa-edit"></i>Edit</button>
                      <!-- Edit Modal -->
                      <div class="modal fade bd-example-modal-lg" id="editModal{{ $courseTeacher->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Update Course Teacher</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form action="{{ route('admin.courseTeacher.update', $courseTeacher->id) }}" method="post">
                                @csrf

                                <div class="form-row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="course_id">Course Code</label>
                                      <select class="form-control" name="course_id" id="course_id" required>
                                        @foreach ($courses as $course)
                                          <option value="{{ $course->id }}" {{ ($course->id == $courseTeacher->course_id) ? 'selected' : '' }}>{{ $course->code }}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="teacher_id">Course Teacher</label>
                                      <select class="form-control" name="teacher_id" id="teacher_id" required>
                                        @foreach ($teachers as $teacher)
                                          <option value="{{ $teacher->id }}" {{ ($teacher->id == $courseTeacher->teacher_id) ? 'selected' : '' }}>{{ $teacher->first_name.' '.$teacher->first_name }}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>
                                </div>

                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Update Course Teacher</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        </div>

                      <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $courseTeacher->id }}"><i class="fa fa-fw fa-trash"></i>Delete</button>
                      <!-- Delete Modal-->
                      <div class="modal fade" id="deleteModal{{ $courseTeacher->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Are you sure want to delete this course teacher ?</h5>
                              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body">Please confirm if you want to delete</div>
                            <div class="modal-footer">
                              <button class="btn btn-outline-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
                              <form class="" action="{{ route('admin.courseTeacher.delete', $courseTeacher->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i> Confirm</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>
      </div>
    </div>
  </div>


  <!-- Add Modal -->
  <div class="modal fade bd-example-modal-lg" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Course Teacher</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('admin.courseTeacher.store') }}" method="post">
            @csrf

            <div class="form-row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="course_id">Course Code</label>
                  <select class="form-control" name="course_id" id="course_id" required>
                    <option value="">Select Course</option>
                    @foreach ($courses as $course)
                      <option value="{{ $course->id }}">{{ $course->code }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="teacher_id">Course Teacher</label>
                  <select class="form-control" name="teacher_id" id="teacher_id" required>
                    <option value="">Select Teacher</option>
                    @foreach ($teachers as $teacher)
                      <option value="{{ $teacher->id }}">{{ $teacher->first_name.' '.$teacher->first_name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Add Course Teacher</button>
            </div>
          </form>
        </div>
      </div>
    </div>

@endsection
