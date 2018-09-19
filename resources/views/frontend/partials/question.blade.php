<div class="row mt-10">
  <h3><i>Review Question</i></h3>
  <form class="" action="{!! route('teacher.review.submit') !!}" method="post">
    @csrf

    <input type="hidden" name="courseTeacherId" value="{{ $courseTeacherId }}">
    <input type="hidden" name="teacherId" value="{{ $teacher->id }}">

    @php $i = 0;  @endphp
    <div class="row">
      @foreach(\App\Models\ReviewQuestion::all() as $question)
        @php
        $i++;
        $answer = 'answer'.$i;
        @endphp

        <div class="col-md-6 panel panel-default mt-3" style="background-color: #2F4F4F">
          <div class="panel-body single-link">
            <div class="row">
              <div class="col-md-8"><b><font color="#FFF">{{ $question->question }}</b></div>
                <input type="hidden" name="question_ids[]" value="{{ $question->id }}">
                <div class="col-md-4">
                  <input type="radio" name="{{ $answer }}" value="5">
                  <label for="">Best</label>

                  <input type="radio" name="{{ $answer }}" value="4">
                  <label for="">Better</label>

                  <input type="radio" name="{{ $answer }}" value="3">
                  <label for="">Good</label>

                  <input type="radio" name="{{ $answer }}" value="2">
                  <label for="">Average</label>

                  <input type="radio" name="{{ $answer }}" value="1">
                  <label for="">Worst</label></font>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <input type="hidden" name="totalQuestion" value="{{ $i }}">
      @if(Auth::guard('student')->check())
        @if($level == Auth::guard('student')->user()->level && $semester == Auth::guard('student')->user()->semester)
          <button type="submit" class="btn btn-primary btn-block float-right mt-3" name="button">Submit Review</button>
        @else
          <h2 class="text-danger">You are not allowed to submit review of this course</h2>
        @endif
      @else
        <h2 class="text-danger">Please Login first to submit review</h2>
        <a href="{!! route('student.login') !!}" class="btn btn-primary">Login</a>
      @endif
    </form>

  </div>
