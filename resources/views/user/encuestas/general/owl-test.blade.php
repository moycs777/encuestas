@extends('user.layouts.app2')

@push('styles')
<link rel="stylesheet" href="{{ asset('OwlCarousel2-2.2.1\dist\assets/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('OwlCarousel2-2.2.1\dist\assets/owl.theme.default.min.css') }}">
@endpush

@section('content')
<div class="container">
  <br><br><br><br>
    <div class="row">
    <p>{{-- categoria  {{ $encuesta->category }} --}}
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
          <div class="col-md-12">
            <div class=""><br>               
                <div class="sec-title text-center">
                  <h2 class="wow animated text-center" style="color: #999999;">qwl-test {{ $encuesta->name }}</h2>
                </div>
                @if ($encuesta->category->timer_type >1)                
                  <div style="text-align:center;">
                    <p>Tiempo para responder: {{ $encuesta->category->hour }}:{{ $encuesta->category->minutes }}:{{ $encuesta->category->seconds }}</p>
                    <div id="cabecera"></div>
                    <p>Tiempo restante:</p>
                    <div style="color:#337ab7; font-family: verdana, arial; font-size:30px; padding:15px;" id ="displayReloj" > &nbsp;
                    </div>
                    <h2 id='CuentaAtras'></h2>
                  </div>
                @endif
                <div 
                    
                  @if (!$preguntas == null)
                    @foreach ($preguntas as $pregunta)
                        
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
                <input type="text" id="arreglo" class="form-control" placeholder="" name="arreglo[]">
            </div>
        </div>
          </form>
    </div>
    <div class="owl-carousel owl-theme">
                        <div class="item"><h4>1</h4></div>
                        <div class="item"><h4>2</h4></div>
                        <div class="item"><h4>3</h4></div>
                        <div class="item"><h4>4</h4></div>
                        <div class="item"><h4>5</h4></div>
                        <div class="item"><h4>6</h4></div>
                        <div class="item"><h4>7</h4></div>
                        <div class="item"><h4>8</h4></div>
                        <div class="item"><h4>9</h4></div>
                        <div class="item"><h4>10</h4></div>
                        <div class="item"><h4>11</h4></div>
                        <div class="item"><h4>12</h4></div>
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

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/encuestas/general.js') }}"></script>
@endpush

<script src="{{ asset('admin/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script src="owlcarousel/owl.carousel.min.js"></script>
<script>    
console.log("no ha iniciado jq 2");
$(function () {
  
  console.log("regitrar encuestas con $ each 2"); 
  console.log("hay tiempo " + {{ $timer }} ); 
  
  //Mostramos la 1era pagina de rpeguntas
  var elem = document.getElementById('div_1');
  elem.style.display = 'block';

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

    if ( hour == null || hour == '') {hour=0; }
    if ( min == null || min == '') {min=0; }
    if ( seg == null || seg == '') {seg=0; }

    console.log("Encuesta por tiempo "); 
    
    console.log("horas" + hour + " ,minutos: " + min + " " + " ,segundos: " + seg);

    function reloj() {

      if (seg > 0) {
         seg = seg - 1;
      }

      if ((min > 0)  && (seg == 0)){
          min = min - 1;
          seg = 60;
      }

      if ((hour > 0) && (min == 0)){
          hour = hour - 1;
          min = 60;
      }

      if ((hour == 0) && (min == 0) && (seg == 0)){
         document.getElementById('displayReloj').innerHTML = hour + " : " + min + " : " + seg;
         document.getElementById('evaluar').click();
         alert("Fin : " + nn);
         exit();
      }
      
        document.getElementById('displayReloj').innerHTML = hour + ":" + min + ":" + seg;
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
      //alert("asd");
      console.log("funcion evaluar");
      var preguntas_input = $(":input");      
      //var preguntas_input = $("[name=respuestas]");
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


