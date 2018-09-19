<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReviewQuestion;
use Session;

class ReviewQuestionController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:admin');
  }

  /**
  * [show all review_questons to backend.pages.review-question.index page]
  */
  public function index()
  {
    $questions =  ReviewQuestion::orderBy('id', 'DESC')->get();
    return view('backend.pages.review-question.index', compact('questions'));
  }


  /**
  * store all the information of form to the database
  */
  public function store(Request $request)
  {
    $question = new ReviewQuestion();

    $this->validate($request, [
      'question' => 'required|unique:review_questions',
      'question_type' => 'required'
    ]);

    $question->question = $request->question;
    $question->question_type = $request->question_type;
    $question->save();

    session()->flash('success', 'Review Question added successfully');
    return redirect()->route('admin.question.index');
  }


  /**
  * update all the information of form to the database
  */
  public function update(Request $request, $id)
  {
    $question = ReviewQuestion::find($id);

    $this->validate($request, [
      'question' => 'required|unique:review_questions,question,'.$question->id,
      'question_type' => 'required'
    ]);

    $question->question = $request->question;
    $question->question_type = $request->question_type;
    $question->save();

    session()->flash('success', 'Review Question updated successfully');
    return redirect()->route('admin.question.index');
  }


  /**
  * delete question from the database
  */
  public function destroy($id)
  {
    ReviewQuestion::find($id)->delete();
    session()->flash('error', 'Review Question deleted successfully');
    return redirect()->route('admin.question.index');
  }
}
