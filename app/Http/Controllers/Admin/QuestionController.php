<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Poll;
use App\Question;
use App\Answer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $polls = Poll::all();
       return view('admin.questions.index',compact('polls'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function showquestions($id)
    {
        //return $id;
        $encuesta = Poll::find($id);
        $preguntas = Question::where('poll_id', '=', $encuesta->id)
            ->get();
        //dd($encuesta);
        //dd($preguntas->count());
        //Este se cumple cuando una encuesta ya tiene preguntas
       /* if ($preguntas->count()>=1) {
            
        }*/
        //Cuando la encuesta no tiene preguntas
        return view('admin.questions.create', compact('encuesta', 'preguntas'));
        
    }

    public function createquestion(Request $request){
        //return $request->all();
        //dd( $request->all());
        $rules = array (
                    'name' => 'required'
            );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails ())
            return Response::json ( array (
                'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        else {
            $data = new Question ();
            $data->name = $request->name;
            $data->poll_id = $request->poll_id;
            $data->save ();
            return response ()->json ( $data );
        }
    }

    public function deletequestion(Request $request)
    {
        Question::where('id', $request->id)->delete();
        return $request->all();
    }

    public function updatequestion(Request $request)
    {
        $question = Question::find($request->id);
        $question->name = $request->name;
        $question->save();
        
        return $request->all();
    }
    
    
    
    public function createanswer(Request $request){
        //return $request->all();
        //dd( $request->all());
        $rules = array (
                    'name' => 'required',
                    'value' => 'required'
            );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails ())
            return Response::json ( array (
                'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        else {
            $data = new Answer ();
            $data->name = $request->name;
            $data->value = $request->value;
            $data->question_id = $request->question_id;
            $data->save ();
            return response ()->json ( $data );
        }
    }

    public function deleteanswer(Request $request)
    {
        Question::where('id', $request->id)->delete();
        return $request->all();
    }

    public function updateanswer(Request $request)
    {
        $question = Question::find($request->id);
        $question->name = $request->name;
        $question->save();
        
        return $request->all();
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
