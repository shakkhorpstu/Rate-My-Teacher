@extends('backend.layouts.master')

@section('content')

  <div class="app-title">
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
      <li class="breadcrumb-item active">Teacher</li>
    </ul>
  </div>

  @include('backend.partials.message')

  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="card">
          <div class="card-header">
            <i class="fa fa-table"></i> <span class="ml-2">Teachers Of PSTU</span>
            <button class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#addModal">Add Teacher</button>
          </div>
        </div>
        <div class="tile-body mt-4">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Faculty</th>
                <th>Department</th>
                <th>Image</th>
                <th>Manage</th>
              </tr>
            </thead>
            <tbody>
              @if(!empty($teachers))
                @foreach($teachers as $teacher)
                  <tr>
                    <td>{{ $teacher->first_name.' '.$teacher->last_name }}</td>
                    <td>{{ $teacher->phone }}</td>
                    <td>{{ $teacher->email }}</td>
                    <td>{{ $teacher->faculty->short_name }}</td>
                    <td>{{ $teacher->department->short_name }}</td>
                    <td><a href="{{ asset('public/image/teachers/'.$teacher->image) }}" target="
                      "><img src="{{ asset('public/image/teachers/'.$teacher->image) }}" alt="" style="width: 50px; height: 50px;"></a></td>
                    <td>
                      <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal{{ $teacher->id }}"><i class="fa fa-fw fa-edit"></i>Edit</button>
                      <!-- Edit Modal -->
                      <div class="modal fade bd-example-modal-lg" id="editModal{{ $teacher->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Update Teacher</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form action="{{ route('admin.teacher.update', $teacher->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                  <div class="col-md-6 form-group">
                                    <label for="first_name">First Name <span class="text-danger required">*</span></label>
                                    <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" value="{{ $teacher->first_name }}" required>
                                  </div>
                                  <div class="col-md-3 form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" value="{{ $teacher->last_name }}">
                                  </div>
                                  <div class="col-md-3 form-group">
                                    <label for="image">Image</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                  </div>
                                </div>

                                <div class="form-row">
                                  <div class="col-md-6 form-group">
                                    <label for="phone">Phone <span class="text-danger required">*</span></label>
                                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone Number" value="{{ $teacher->phone }}" required>
                                  </div>
                                  <div class="col-md-6 form-group">
                                    <label for="email">Email <span class="text-danger required">*</span></label>
                                    <input type="text" name="email" id="email" class="form-control" placeholder="Email Address" value="{{ $teacher->email }}" required>
                                  </div>
                                </div>

                                <div class="form-row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="faculty_id">Faculty</label>
                                      <select class="form-control" name="faculty_id" id="faculty_id" required>
                                        @foreach ($faculties as $faculty)
                                          <option value="{{ $faculty->id }}" {{ ($faculty->id == $teacher->faculty_id) ? 'selected' : '' }}>{{ $faculty->short_name }}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="department_id">Department</label>
                                      <select class="form-control" name="department_id" id="department_id" required>
                                        @foreach ($departments as $department)
                                          <option value="{{ $department->id }}" {{ ($department->id == $teacher->department_id) ? 'selected' : '' }}>{{ $department->short_name }}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>
                                </div>

                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Update Teacher</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        </div>

                      <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $teacher->id }}"><i class="fa fa-fw fa-trash"></i>Delete</button>
                      <!-- Delete Modal-->
                      <div class="modal fade" id="deleteModal{{ $teacher->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Are you sure want to delete this teacher ?</h5>
                              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body">Please confirm if you want to delete</div>
                            <div class="modal-footer">
                              <button class="btn btn-outline-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
                              <form class="" action="{{ route('admin.teacher.delete', $teacher->id) }}" method="post">
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
          <h5 class="modal-title">Add Teacher</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('admin.teacher.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
              <div class="col-md-6 form-group">
                <label for="first_name">First Name <span class="text-danger required">*</span></label>
                <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" required>
              </div>
              <div class="col-md-3 form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name">
              </div>
              <div class="col-md-3 form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control">
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
              <div class="col-md-6">
                <div class="form-group">
                  <label for="faculty_id">Faculty <span class="text-danger required">*</span></label>
                  <select class="form-control" name="faculty_id" id="faculty_id" required>
                    <option value="">Select Faculty</option>
                    @foreach ($faculties as $faculty)
                      <option value="{{ $faculty->id }}">{{ $faculty->short_name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="department_id">Department <span class="text-danger required">*</span></label>
                  <select class="form-control" name="department_id" id="department_id" required>
                    <option value="">Select Department</option>
                    @foreach ($departments as $department)
                      <option value="{{ $department->id }}">{{ $department->short_name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Add Teacher</button>
            </div>
          </form>
        </div>
      </div>
    </div>

@endsection
