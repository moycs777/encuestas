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
use App\Category;
use App\Poll;
use App\Range;
use App\Resume;
use App\MasterAplication;
use App\DetailAplication;
use App\Question;

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
        if ($request->id_respuestas == null) {
            return redirect()->back()->with('message', 'Debes responder al menos 1pregunta!');
        }
        //dd($st);
        //dd($request->all());
        //dd($request->respuestas);
        $this->validate($request,[
            'respuestas' => 'required',
        ]);
        $st = Session::get('start_date');
        $master_aplication = new MasterAplication();
        $master_aplication->start_date = $st; 
        $master_aplication->user_id = 1;
        $master_aplication->poll_id = $request->poll_id;;
        $master_aplication->status = 0;
        $master_aplication->save();

        

        $encuesta = Poll::find($request->poll_id);
        $preguntas = Question::where('poll_id', '=', $request->poll_id)->get();
        //$respuestas = Answer::where('poll_id', $encuesta->id)->get();
        $total = 0;

        AplicationPoll::where('user_id', '=', 1)
            ->where('poll_id', '=', $request->poll_id)
            ->delete();

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
        $master_aplication = MasterAplication::where('poll_id', '=', $id)
            ->where('user_id', '=', 10)
            ->first();
        if (!$master_aplication == null) {
            //Cuando la encuesta esta cerrada
            if ($master_aplication->status == 1) {
                return "la encusta esta cerrada";
            }
            //Cando reanudamos la encuesta
            $detail_aplication = DetailAplication::where('master_aplication_id', '=', $master_aplication->id)->get();
            $encuesta = Poll::find($id);
            $preguntas = Question::where('poll_id', '=', $encuesta->id)
                ->get();
            return view('user.encuestas.show', compact('encuesta', 'preguntas', 'detail_aplication'));
        }
        //Creacion de una encusta
        //creacion de el maestro
        Session::put('start_date', Carbon::now()->format('Y-m-d H:i:s'));
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
