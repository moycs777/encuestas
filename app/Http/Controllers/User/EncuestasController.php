<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Answer;
use App\Poll;
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
        //dd($request->all());
        //dd($request->respuesta_id);
        $encuesta = Poll::find($request->poll_id);
        $preguntas = Question::where('poll_id', '=', $request->poll_id)->get();
        //$respuestas = Answer::where('poll_id', $encuesta->id)->get();
        $total = 0;
        foreach ($request->respuesta_id as $key => $value) {
            print_r('llave: '.$key .' valor: '. $value. ' ');
            $total += Answer::where('id', $value)->first()->value;
        }
      
        return ' Total: '. $total;
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