@extends('frontend.layouts.master')

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-sm-8">
        <h3 style="margin-left: 50px"><b><i>Rate`My`Teachers</i></b></h3>
      </div>
    </div>

    <div class="row mt-10">
      @php $totalQuestion = \App\Models\ReviewQuestion::count();  @endphp
      <h3><i>Reviews Of {{ $teacher->first_name }}</i></h3>
      @foreach(\App\Models\ReviewQuestion::all() as $question)
        <div class="col-md-4">
          <div class="panel panel-default answer-panel" style="background-color: #2F4F4F">
            <div class="panel-body single-link">
              <h4><b><font color="#FFF">
                <div class="col-md-9">
                  <span class="text-center mb-2">{{ $question->question }}</span>
                  <p class="mt-5 text-center text-percent">{{ \App\Models\ReviewQuestionAnswer::countThisAnswer($courseTeacherId, $teacher->id, $year, $question->id) }}</p>
                </div>
              </font>
              <b/>
            </h4>
          </div>
        </div>
      </div>
    @endforeach
  </div>
  @include('frontend.partials.question')
</div>

@endsection
