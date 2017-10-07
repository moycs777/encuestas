<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Poll;
use App\Question;
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

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
