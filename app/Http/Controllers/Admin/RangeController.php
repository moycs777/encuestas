<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Poll;
use App\Range;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class RangeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $polls = Poll::all();
        return view('admin.ranges.index', compact('polls'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();
        //dd( $request->all());
        $rules = array (
                    'from' => 'required',
                    'to' => 'required',
                    'text' => 'required',
            );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails ())
            return Response::json ( array (
                'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        else {
            $data = new Range ();
            $data->from = $request->from;
            $data->to = $request->to;
            $data->text = $request->text;
            $data->poll_id = $request->poll_id;
            $data->save ();
            return response ()->json ( $data );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         //return $id;
         $poll = Poll::find($id);
         $ranges = Range::where('poll_id', '=', $poll->id)
             ->get();
         
         return view('admin.ranges.show', compact('poll', 'ranges'));
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
