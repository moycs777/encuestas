@extends('user.layouts.app2')
@section('content')
<div class="container">
  <br><br><br><br>
    <div class="row">
    <p>categoria  {{ $encuesta->category }}
      @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
      @endif
     </p>
        <input  type="hidden" id="seconds" value="{{ $encuesta->category->seconds }}" >
        <form action="{{ route('encuestas.store') }}" method="post" id="formid"> 
            {{ csrf_field()  }} 
            <input type="hidden" name="poll_id" value="{{ $encuesta->id }}">
            <div class="myform">
                {{-- <input type="hidden" name="respuesta_id[]" value="">     --}}            
            </div>
        <div class="col-md-12 {{-- col-md-offset-2 --}}">
            <div class="panel panel-default">
                <div class="panel-heading">Reanudar Encuesta</div>
                <div style="text-align:center;">
                    <!-- <div style="color:blue; font-family: verdana, arial; font-size:30px; padding:15px;" id ="fecha" > &nbsp; </div> -->
                    <!-- <input type = "text" name="fecha" id="fecha" > -->
                  <div id="cabecera"><h2>XXXXXXXX</h2><h3>Ejemplos JavaScript</h3></div>
                  <div style="color:blue; font-family: verdana, arial; font-size:30px; padding:15px;" id ="displayReloj" > &nbsp; </div>
                  <h1>Cuenta atras para redfinalizar la encusta</h1>
                  <h2 id='CuentaAtras'></h2>
                </div>
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
                                <div class="col-md-4 col-xs-4">
                                    <p>{{  $pregunta->name }}</p>
                                </div>
                                {{-- Respuestas --}}                            
                                <div class="col-md-8 col-xs-6">                              
                                  
                                    @foreach($pregunta->answers as $answer)
                                     {{--  <p>no hay respuesta aun</p> --}}
                                      @if ($pregunta->multiple_answers == 1)
                                          <input type="checkbox" 
                                          name="respuestas" 
                                          value="{{ $answer->id }}" 
                                          class="chk" 
                                          id="{{ $answer->id }}" 
                                          @if (!$contestadas == null)
                                            @foreach ($contestadas as $item)
                                              @if ($item->answer_id == $answer->id)
                                                checked
                                              @endif
                                            @endforeach
                                          @endif
                                          > 
                                          {{ $answer->name }}
                                      @else
                                          <input type="radio" 
                                          name="respuestas" 
                                          value="{{ $answer->id }}" 
                                          class="rad" 
                                          id="{{ $answer->id }}" 
                                          @foreach ($contestadas as $item)
                                            @if ($item->answer_id == $answer->id)
                                              checked
                                            @endif
                                          @endforeach
                                          > 
                                          {{ $answer->name }}
                                      @endif
                                    @endforeach
                                
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <!-- <input type="submit"   value="Registrar encuesta" > --> 
                <button id="evaluar" class="btn btn-danger">Terminar encuesta</button>
                @if($encuesta->category->pausable == 0)
                    <input type="hidden" name="pausable" value="0">                    
                @else
                    <button id="pausar" class="btn btn-success">pausar encuesta</button>
                    <input type="hidden" name="pausable" value="1">                    
                @endif
                <input type="text" id="arreglo" class="form-control" placeholder="Titel" name="arreglo[]">
            </div>
        </div>
        </form>
    </div>
    @php
      if ($encuesta->category->hour > 0 || $encuesta->category->minutes > 0 || $encuesta->category->seconds > 0) 
      {
        $timer = 1;
      } else {
        $timer = 0;
      }
      
    @endphp
</div>
<div>
  <input type="hidden" id="hour" name="hour" value="{{ $encuesta->category->hour }}">
  <input type="hidden" id="min" name="min" value="{{ $encuesta->category->minutes }}">
  <input type="hidden" id="seg" name="seg" value="{{ $encuesta->category->seconds }}">
</div>
<script src="{{ asset('admin/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script>    
console.log("no ha iniciado jq 2");
$(function () {
  
  console.log("regitrar encuestas con $ each 2"); 
  console.log("hay tiempo " + {{ $timer }} ); 
  $("input:submit").click(function() { return false; });
  
  var poll_id = {{ $encuesta->id }};
  //var respuestas = [];
  
  $('.question').click(function(){
    console.log("se clickeo un elemento de pregunta");
  });

  //Encuesta por tiempo
  if ( {{ $timer }} == 1) 
  {
    var n = 0;
    var nn = 0;
    var hour = $('input[name=hour]').val();
    var min = $('input[name=min]').val();
    var seg = $('input[name=seg]').val();

    if ( hour == null) {hour=0; }
    if ( min == null) {min=0; }
    if ( seg == null) {seg=0; }

    
    console.log("Encuesta por tiempo "); 
    
    
    console.log("minutos: " + min + " " + "segundos: " + seg);

    function reloj() {

      if (seg > 0) {
           seg = seg - 1;
        }

      if ((min > 0)  && (seg == 0)){
            min = min - 1;
            seg = 60;
        }

        if ((min == 0) && (seg == 0)){
          document.getElementById('displayReloj').innerHTML = min + " : " + seg;
          alert("Fin : " + nn);
        exit();
        }
      
        document.getElementById('displayReloj').innerHTML = min + " : " + seg;
        var t = setTimeout(function(){reloj()},1000);
    }
    reloj();
    
    
  }

  //Encuesta sin tiempo
  if ( {{ $timer }} == 0) 
  {
    console.log("Encuesta sin tiempo "); 
    
  }

  $("#evaluar").click(function(){
      var preguntas_input = $("[name=respuestas]");
      var i = 0;
      preguntas_input.each(function(index , valor){
          //alert("id: " + $(this).attr('id') + " , esrtado: " + $(this).tagName + " valor: " + valor + ": " + $( this ).text() );
        if ( $(this).prop( "checked" ) ) {
         // alert("esta checked, " + $(this).attr('id') );
          //arreglo[index] = $(this).attr('id');
          //$('[name=arreglo]').val(this.value);
          id = $(this).attr('id');
          nombre = 'id_respuestas['+i+']';
          //alert("nombre: " + nombre);
          //alert("id: " + id);
          $('<input>').attr({
              type: 'hidden',
              id: 'foo',
              name: nombre,
              value: id
          }).appendTo('form');
          i += 1;
        }

      });
  });

});
    
    

</script>

@endsection



