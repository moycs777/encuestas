<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $encuesta = Poll::find($request->poll_id);
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
