@extends('backend.layouts.master')

@section('content')

<div class="app-title">
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Student</li>
  </ul>
</div>

@include('backend.partials.message')

<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <div class="card">
        <div class="card-header">
          <i class="fa fa-table"></i> <span class="ml-2">Students Of PSTU</span>
          <button class="btn btn-success btn-sm ml-2 float-right" data-toggle="modal" data-target="#jhamelaModal">Add From Excel</button>
          <a class="btn btn-primary btn-sm float-right" href="{{ route('admin.student.add') }}">Add Student</a>
          <a href="{!! route('admin.student.upgradeSemester') !!}" class="btn btn-info btn-sm float-right mr-2">Upgrade Semester Of All Student</a>
        </div>
      </div>
      <div class="tile-body mt-4">
        <table class="table table-hover table-bordered" id="sampleTable">
          <thead>
            <tr>
              <th>Name</th>
              <th>ID</th>
              <th>Reg. No.</th>
              <th>Faculty</th>
              <th>Session</th>
              <th>Level</th>
              <th>Semester</th>
              <th>Manage</th>
            </tr>
          </thead>
          <tbody>
            @if(!empty($students))
            @foreach($students as $student)
            <tr>
              <td>{{ $student->name }}</td>
              <td>{{ $student->university_id }}</td>
              <td>{{ $student->registration_no }}</td>
              <td>{{ $student->faculty->short_name }}</td>
              <td>{{ $student->session }}</td>
              <td>{{ $student->level }}</td>
              <td>{{ $student->semester }}</td>
              <td>
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal{{ $student->id }}" title="Edit Student"><i class="fa fa-fw fa-edit"></i></button>
                <!-- Edit Modal -->
                <div class="modal fade bd-example-modal-lg" id="editModal{{ $student->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Update Student</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="{{ route('admin.student.update', $student->id) }}" method="post" enctype="multipart/form-data">
                          @csrf
                          <div class="form-row">
                            <div class="col-md-6 form-group">
                              <label for="name">Name <span class="text-danger required">*</span></label>
                              <input type="text" name="name" id="name" class="form-control" placeholder="Student Name" value="{{ $student->name }}" required>
                            </div>
                            <div class="col-md-6 form-group">
                              <label for="faculty_id">Faculty <span class="text-danger required">*</span></label>
                              <select class="form-control" name="faculty_id" id="faculty_id" required>
                                @foreach ($faculties as $faculty)
                                <option value="{{ $faculty->id }}">{{ $faculty->short_name }}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>

                          <div class="form-row">
                            <div class="col-md-6 form-group">
                              <label for="phone">Phone <span class="text-danger required">*</span></label>
                              <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone Number" value="{{ $student->phone }}" required>
                            </div>
                            <div class="col-md-6 form-group">
                              <label for="email">Email <span class="text-danger required">*</span></label>
                              <input type="text" name="email" id="email" class="form-control" placeholder="Email Address" value="{{ $student->email }}" required>
                            </div>
                          </div>

                          <div class="form-row">
                            <div class="col-md-6 form-group">
                              <label for="session">Session <span class="text-danger required">*</span></label>
                              <input type="text" name="session" id="session" class="form-control" placeholder="Session" value="{{ $student->session }}" required>
                            </div>
                            <div class="col-md-3 form-group">
                              <label for="level">Level <span class="text-danger required">*</span></label>
                              <select class="form-control" name="level" id="level">
                                <option value="1" {{ ($student->level == 1) ? 'selected' : '' }}>Level - 1</option>
                                <option value="2" {{ ($student->level == 2) ? 'selected' : '' }}>Level - 2</option>
                                <option value="3" {{ ($student->level == 3) ? 'selected' : '' }}>Level - 3</option>
                                <option value="4" {{ ($student->level == 4) ? 'selected' : '' }}>Level - 4</option>
                              </select>
                            </div>
                            <div class="col-md-3 form-group">
                              <label for="semester">Semester <span class="text-danger required">*</span></label>
                              <select class="form-control" name="semester" id="semester">
                                <option value="1" {{ ($student->semester == 1) ? 'selected' : '' }}>1st Semester</option>
                                <option value="2" {{ ($student->semester == 2) ? 'selected' : '' }}>2nd Semester</option>
                              </select>
                            </div>
                          </div>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update Student</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $student->id }}" title="Delete Student"><i class="fa fa-fw fa-trash"></i></button>
                <!-- Delete Modal-->
                <div class="modal fade" id="deleteModal{{ $student->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Are you sure want to delete this student ?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div class="modal-body">Please confirm if you want to delete</div>
                      <div class="modal-footer">
                        <button class="btn btn-outline-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
                        <form class="" action="{{ route('admin.student.delete', $student->id) }}" method="post">
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

  <!-- Excel Modal -->
  <div class="modal fade" id="jhamelaModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Excel File</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('admin.student.uploadExcel') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="file">ExcelFile</label>
              <input type="file" class="form-control" name="file" id="file" required>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Upload File</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  @endsection
