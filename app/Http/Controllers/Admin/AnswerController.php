<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Poll;
use App\Question;
use App\Answer;
use Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class AnswerController extends Controller
{
    
    public function index()
    {
        //
    }

    
    public function create(Request $request)
    {
        //dd($request->all());
        $poll = Poll::find($request->poll_id);
        $question = Question::find($request->question_id);
        return view('admin.answers.create', compact('poll', 'question'));
        
    }

    
    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request, ['name' => 'required' ]);

        $answer = Answer::create($request->all());

        Session::flash('message', 'answer added!');
        Session::flash('status', 'success');

        $poll = Poll::find($request->poll_id);
        $questions = Question::where('poll_id', '=', $request->poll_id)
             ->get();
        return view('admin.questions.index',compact('poll', 'questions'));
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
}
