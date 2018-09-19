@extends('backend.layouts.master')

@section('content')

  <div class="app-title">
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
      <li class="breadcrumb-item active">Review Question</li>
    </ul>
  </div>

  @include('backend.partials.message')

  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="card">
          <div class="card-header">
            <i class="fa fa-table"></i> <span class="ml-2">Review Questions Of PSTU</span>
            <button class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#addModal">Add Question</button>
          </div>
        </div>
        <div class="tile-body mt-4">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th>Question</th>
                <th>Category</th>
                <th>Manage</th>
              </tr>
            </thead>
            <tbody>
              @if(!empty($questions))
                @foreach($questions as $question)
                  <tr>
                    <td>{{ $question->question }}</td>
                    <td>{{ $question->question_type == 0 ? 'Academic' : 'Non-academic' }}</td>
                    <td>
                      <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal{{ $question->id }}"><i class="fa fa-fw fa-edit"></i>Edit</button>
                      <!-- Edit Modal -->
                      <div class="modal fade bd-example-modal-lg" id="editModal{{ $question->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Update Question</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form action="{{ route('admin.question.update', $question->id) }}" method="post">
                                @csrf
                                <div class="form-row">
                                  <div class="col-md-6 form-group">
                                    <label for="question">Review Question <span class="text-danger required">*</span></label>
                                    <input type="text" name="question" id="question" class="form-control" placeholder="Review Question" value="{{ $question->question }}" required>
                                  </div>
                                  <div class="col-md-6 form-group">
                                    <label for="question_type">Question Category <span class="text-danger required">*</span></label>
                                    <select class="form-control" name="question_type" id="question_type" required>
                                      <option value="0" {{ $question->question_type == 0 ? 'selected' : '' }}>Academic</option>
                                      <option value="1" {{ $question->question_type == 1 ? 'selected' : '' }}>Non-Academic</option>
                                    </select>
                                  </div>
                                </div>

                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Update Question</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>

                      <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $question->id }}"><i class="fa fa-fw fa-trash"></i>Delete</button>
                      <!-- Delete Modal-->
                      <div class="modal fade" id="deleteModal{{ $question->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Are you sure want to delete this question ?</h5>
                              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body">Please confirm if you want to delete</div>
                            <div class="modal-footer">
                              <button class="btn btn-outline-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
                              <form class="" action="{{ route('admin.question.delete', $question->id) }}" method="post">
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
            <h5 class="modal-title">Add Question</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{ route('admin.question.store') }}" method="post">
              @csrf
              <div class="form-row">
                <div class="col-md-6 form-group">
                  <label for="question">Review Question <span class="text-danger required">*</span></label>
                  <input type="text" name="question" id="question" class="form-control" placeholder="Review Question" required>
                </div>
                <div class="col-md-6 form-group">
                  <label for="question_type">Question Category <span class="text-danger required">*</span></label>
                  <select class="form-control" name="question_type" id="question_type" required>
                    <option value="">Select Question Category</option>
                    <option value="0">Academic</option>
                    <option value="1">Non-Academic</option>
                  </select>
                </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add Question</button>
              </div>
            </form>
          </div>
        </div>
      </div>

    @endsection
