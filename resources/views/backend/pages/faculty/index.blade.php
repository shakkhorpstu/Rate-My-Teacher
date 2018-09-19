@extends('backend.layouts.master')

@section('content')

  <div class="app-title">
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
      <li class="breadcrumb-item active">Faculty</li>
    </ul>
  </div>

  @include('backend.partials.message')

  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="card">
          <div class="card-header">
            <i class="fa fa-table"></i> <span class="ml-2">Faculties Of PSTU</span>
            <button class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#addModal">Add Faculty</button>
          </div>
        </div>
        <div class="tile-body mt-4">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th>Name</th>
                <th>Short Name</th>
                <th>Manage</th>
              </tr>
            </thead>
            <tbody>
              @if(!empty($faculties))
                @foreach($faculties as $faculty)
                  <tr>
                    <td>{{ $faculty->name }}</td>
                    <td>{{ $faculty->short_name }}</td>
                    <td>
                      <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal{{ $faculty->id }}"><i class="fa fa-fw fa-edit"></i>Edit</button>
                      <!-- Edit Modal -->
                      <div class="modal fade bd-example-modal-lg" id="editModal{{ $faculty->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Update Faculty</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form action="{{ route('admin.faculty.update', $faculty->id) }}" method="post">
                                @csrf
                                <div class="form-row">
                                  <div class="col-md-6 form-group">
                                    <label for="name">Name <span class="text-danger required">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Faculty Name" value="{{ $faculty->name }}" required>
                                  </div>
                                  <div class="col-md-6 form-group">
                                    <label for="short_name">Short Name <span class="text-danger required">*</span></label>
                                    <input type="text" name="short_name" id="short_name" class="form-control" placeholder="Faculty Short Name" value="{{ $faculty->short_name }}" required>
                                  </div>
                                </div>

                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Update Faculty</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        </div>

                      <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $faculty->id }}"><i class="fa fa-fw fa-trash"></i>Delete</button>
                      <!-- Delete Modal-->
                      <div class="modal fade" id="deleteModal{{ $faculty->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Are you sure want to delete this faculty ?</h5>
                              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body">Please confirm if you want to delete</div>
                            <div class="modal-footer">
                              <button class="btn btn-outline-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
                              <form class="" action="{{ route('admin.faculty.delete',$faculty->id) }}" method="post">
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
          <h5 class="modal-title">Add Faculty</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('admin.faculty.store') }}" method="post">
            @csrf
            <div class="form-row">
              <div class="col-md-6 form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Faculty Name" required>
              </div>
              <div class="col-md-6 form-group">
                <label for="short_name">Short Name</label>
                <input type="text" name="short_name" id="short_name" class="form-control" placeholder="Faculty Short Name" required>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Add Faculty</button>
            </div>
          </form>
        </div>
      </div>
    </div>

@endsection
