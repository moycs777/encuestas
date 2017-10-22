@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <form action="{{ route('encuestas.store') }}" method="post"> 
            {{ csrf_field()  }} 
            <input type="hidden" name="poll_id" value="{{ $encuesta->id }}">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Encuesta</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (!$encuesta == null)
                    
                        <div class="table-responsive">                          
                        <table class="table">
                            <tr>
                                
                            </tr>
                            </thead>
                            <tbody> 
                            <tr>                                
                                <td class="active"><a href="#">{{ $encuesta->name }}</a></td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                    @endif
                    {{-- Preguntas --}}
                    @if (!$preguntas == null)
                        @foreach ($preguntas as $pregunta)
                            <div class="row">
                                <div class="col-md-3">
                                    <p>{{  $pregunta->name }}</p>
                                </div>
                                {{-- Respuestas --}}                            
                                <div class="col-md-9">                              
                                @if (!empty($pregunta->answers))
                                    @foreach($pregunta->answers as $answer)
                                    <input type="radio" 
                                            name="{{  $pregunta->name }}" 
                                            value="{{ $answer->id }}" 
                                            id="{{ $answer->id }}"> {{ $answer->name }}
                                    @endforeach
                                @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <input type="submit" value="Registrar encuesta">
            </div>
        </div>
        </form>
    </div>
</div>
@endsection