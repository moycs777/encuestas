<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\AplicationPoll;
use App\Answer;
use App\Poll;
use App\Range;
use App\Resume;
use App\Question;
use App\Category;

class EncuestasController extends Controller
{
   
    public function index()
    {
        $polls = Poll::all();
        return view('user.encuestas.index', compact('polls'));
    }
  
    public function create()
    {
        //
    }
    
    public function store(Request $request)
    {
        dd($request->all());
        $encuesta = Poll::find($request->poll_id);
        $preguntas = Question::where('poll_id', '=', $request->poll_id)->get();
        //$respuestas = Answer::where('poll_id', $encuesta->id)->get();
        $total = 0;

        foreach ($request->id_respuestas as $key => $value) {
            //print_r('llave: '.$key .' valor: '. $value. ' ');
            $aplication_poll = new AplicationPoll();
            $total += Answer::where('id', $value)->first()->value;
            $answer = Answer::find($value);
            $aplication_poll->start = Carbon::now();
            $aplication_poll->end = Carbon::now();
            $aplication_poll->value = $answer->value;
            $aplication_poll->user_id = 1;
            $aplication_poll->poll_id = $request->poll_id;
            $aplication_poll->answer_id = $answer->id;
            $aplication_poll->save();
        }

        //determinar el rango
        $ranges = Range::where('poll_id', '=', $request->poll_id)->get();
        $range = 0;
        //dd($range);
        foreach ($ranges as $key => $value) {
            if ( $total >= $value->from && $total <= $value->to) {
                $range = $value;
                $resume = new Resume();
                $resume->user_id = 1;
                $resume->poll_id = $request->poll_id;
                $resume->total = $total;
                $resume->from = $value->from;
                $resume->to = $value->to;
                $resume->text = $value->text;
                $resume->save();
                return $resume;
            }
        }
        //return ' Total: '. $total;
    }
   
    public function show($id)
    {
        $encuesta = Poll::find($id);
        $preguntas = Question::where('poll_id', '=', $encuesta->id)
            ->get();
        return view('user.encuestas.show', compact('encuesta', 'preguntas'));

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
