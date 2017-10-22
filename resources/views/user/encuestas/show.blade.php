@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <form action="{{ route('encuestas.store') }}" method="post"> 
            {{ csrf_field()  }} 
            <input type="hidden" name="poll_id" value="{{ $encuesta->id }}">
            <div class="myform">
                {{-- <input type="hidden" name="respuesta_id[]" value="">     --}}            
            </div>
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
                                <div class="col-md-3 col-xs-2">
                                    <p>{{  $pregunta->name }}</p>
                                </div>
                                {{-- Respuestas --}}                            
                                <div class="col-md-9 col-xs-4">                              
                                @if (!empty($pregunta->answers))
                                    @foreach($pregunta->answers as $answer)
                                    <input type="radio" 
                                            name="{{  $pregunta->id }}" 
                                            value="{{ $answer->id }}" 
                                            class="rad" 
                                            id="{{ $answer->id }}"> {{ $answer->name }}
                                    @endforeach
                                @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <input type="submit" value="Registrar encuesta" >
            </div>
        </div>
        </form>
    </div>
</div>
<script src="{{ asset('admin/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script>    
console.log("no ha iniciado jq");
$(function () {
    
  console.log("regitrar encuestas"); 
  
  var poll_id = {{ $encuesta->id }};
  var respuestas = [];
  
  $('.question').click(function(){
    console.log("se clickeo un elemento de pregunta");
  });

  $('.rad').click(function(event) {
      console.log(this.value);
      //respuestas.push[this.value];
      $('[name=respuestas]').val(this.value);
      respuesta = this.value;
      pregunta_id = $(this).attr("name");
      name_input = 'respuesta_id['+pregunta_id+']';
      console.log(respuesta + pregunta_id);

      $('<input>').attr({
          type: 'hidden',
          id: 'foo',
          name: name_input/*'respuesta_id[respuesta]'*/,
          value: respuesta
      }).appendTo('form');


      console.log( $('[name=respuesta_id]').val() );
  });




 

    

});
</script>

@endsection



