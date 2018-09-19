@extends('backend.layouts.master')

@section('content')

  <div class="app-title">
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
      <li class="breadcrumb-item active">Department</li>
    </ul>
  </div>

  @include('backend.partials.message')

  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="card">
          <div class="card-header">
            <i class="fa fa-table"></i> <span class="ml-2">Departments Of PSTU</span>
            <button class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#addModal">Add Department</button>
          </div>
        </div>
        <div class="tile-body mt-4">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th>Name</th>
                <th>Short Name</th>
        <th>Faculty</th>
                <th>Manage</th>
              </tr>
            </thead>
            <tbody>
              @if(!empty($departments))
                @foreach($departments as $department)
                  <tr>
                    <td>{{ $department->name }}</td>
                    <td>{{ $department->short_name }}</td>
          <td>{{ $department->faculty->short_name }}</td>
                    <td>
                      <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal{{ $department->id }}"><i class="fa fa-fw fa-edit"></i>Edit</button>
                      <!-- Edit Modal -->
                      <div class="modal fade bd-example-modal-lg" id="editModal{{ $department->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Update Department</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form action="{{ route('admin.department.update', $department->id) }}" method="post">
                                @csrf
                                <div class="form-row">
                                  <div class="col-md-6 form-group">
                                    <label for="name">Name <span class="text-danger required">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Department Name" value="{{ $department->name }}" required>
                                  </div>
                                  <div class="col-md-6 form-group">
                                    <label for="short_name">Short Name <span class="text-danger required">*</span></label>
                                    <input type="text" name="short_name" id="short_name" class="form-control" placeholder="Department Short Name" value="{{ $department->short_name }}" required>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label for="faculty_id">Faculty</label>
                                  <select class="form-control" name="faculty_id" id="faculty_id" required>
                                    @foreach ($faculties as $faculty)
                                      <option value="{{ $faculty->id }}" {{ ($faculty->id == $department->faculty_id) ? 'selected' : '' }}>{{ $faculty->short_name }}</option>
                                    @endforeach
                                  </select>
                                </div>

                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Update Department</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        </div>

                      <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $department->id }}"><i class="fa fa-fw fa-trash"></i>Delete</button>
                      <!-- Delete Modal-->
                      <div class="modal fade" id="deleteModal{{ $department->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Are you sure want to delete this department ?</h5>
                              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body">Please confirm if you want to delete</div>
                            <div class="modal-footer">
                              <button class="btn btn-outline-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
                              <form class="" action="{{ route('admin.department.delete',$department->id) }}" method="post">
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
          <h5 class="modal-title">Add Department</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('admin.department.store') }}" method="post">
            @csrf
            <div class="form-row">
              <div class="col-md-6 form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Department Name" required>
              </div>
              <div class="col-md-6 form-group">
                <label for="short_name">Short Name</label>
                <input type="text" name="short_name" id="short_name" class="form-control" placeholder="Department Short Name" required>
              </div>
            </div>

            <div class="form-group">
              <label for="faculty_id">Faculty</label>
              <select class="form-control" name="faculty_id" id="faculty_id" required>
                <option value="">Select Faculty</option>
                @foreach ($faculties as $faculty)
                  <option value="{{ $faculty->id }}">{{ $faculty->short_name }}</option>
                @endforeach
              </select>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Add Department</button>
            </div>
          </form>
        </div>
      </div>
    </div>

@endsection
