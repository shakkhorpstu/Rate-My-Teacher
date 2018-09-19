@extends('frontend.layouts.master')

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-sm-8">
        <h3 style="margin-left: 50px"><b><i>Rate`My`Teachers</i></b></h3>
      </div>
    </div>

    <div class="row mt-10">
      <h3>Reviews Of {{ $teacher->first_name }}</h3>
      @foreach($reviews as $review)
        <div class="row">
            <div class="panel panel-default mt-3">
              <div class="panel-body single-link">
                <h4>
                  <div class="col-md-2">
                    {{ $review->student->name }}
                  </div>

                  <div class="col-md-9">
                    {{ $review->question->question }}
                    @if($review->rating == 1)
                      {{ "Not Good" }}
                    @elseif($review->rating == 2)
                      {{ "Average" }}
                    @else
                      {{ "Good" }}
                    @endif
                  </div>
                </h4>
              </div>
          </div>
        </div>
      @endforeach
    </div>

    @include('frontend.partials.question')
    
  </div>
@endsection
