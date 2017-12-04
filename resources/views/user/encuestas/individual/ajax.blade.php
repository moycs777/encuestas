@extends('user.layouts.app2')
@section('content')
<div class="container">
  <style>
    .carousel {padding-bottom: 25px}
    .carousel img{padding-top: 20px;}
    .carousel h2 {color: #0072b5;}
    .carousel h2 small{color: #289bde}
    .carousel col-lg-4 p {text-align: center;}
  </style>
  <br><br><br><br>
    <div class="row">
    {{-- <p>Mostrar 1 sola pregunta categoria  @upper( $encuesta->name ) --}}
        <input  type="hidden" id="seconds" value="{{ $encuesta->category->seconds }}" >
        <form action="{{ route('encuestas.individual') }}" method="post" id="formid"> 
            {{ csrf_field()  }} 
            <input type="hidden" name="poll_id" value="{{ $encuesta->id }}">
            <div class="myform">
                {{-- <input type="hidden" name="respuesta_id[]" value="">     --}} 
                <input type="hidden" id="numero_preguntas" value="{{ $numero_preguntas }}">           
            </div>

            <div class="col-md-12 {{-- col-md-offset-2 --}}">
                <div >
                    <h1 class="text-center">{{ $encuesta->name }}</h1><br>
                     {{--  <div style="color:blue; font-family: verdana, arial; font-size:30px; padding:15px;" id ="displayReloj" > &nbsp; </div> --}}
                      <div class='container carousel' id="mycarrousel" data-interval="false">
                        <div id="carousel-example-generic" class="carousel slide" {{-- data-ride="carousel" --}}>
                            <!-- Indicators -->
                            {{-- <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol> --}}
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner text-center" role="listbox">
                              @foreach ($preguntas as $pregunta)

                                @if($loop->index == 0)
                                  <div class="item active">
                                @else  
                                  <div class="item">
                                @endif

                                  <div class="col-lg-4">                            
                                    <h2>¿ {{  $pregunta->name }} ?<br>
                                        </h2>
                                  </div>
                                    <div>
                                      @foreach($pregunta->answers as $answer)
                                        @if ($pregunta->multiple_answers == 1)
                                            <input type="checkbox" 
                                            name="respuestas" 
                                            value="{{ $answer->id }}" 
                                            class="chk" 
                                            id="{{ $answer->id }}"> {{ $answer->name }}
                                        @else
                                            <input type="radio" 
                                            name="respuestas" 
                                            value="{{ $answer->id }}" 
                                            class="rad" 
                                            id="{{ $answer->id }}"> {{ $answer->name }}
                                        @endif
                                      @endforeach
                                      
                                    </div>
                                      
                                  <div>
                                    <a class="" href="#carousel-example-generic"  role="button" data-slide="next" id="next">
                                      <button class="btn btn-primary" id="right.carousel-control">siguiente pregunta</button>
                                    </a>
                                  </div>

                                </div>
                              @endforeach                                
                            </div>                           
                        </div>
                    </div> 
                {{-- <input type="submit"   value="Registrar encuesta" > --}}
                <br>    
                <br>                     
                <!-- <input type="submit"   value="Registrar encuesta" > --> 
                <button id="evaluar" class="btn btn-danger">Terminar encuesta</button>
                @if($encuesta->category->pausable == 0)
                    <input type="hidden" name="pausable" value="0">                    
                @else
                    <button id="pausar" class="btn btn-success">pausar encuesta</button>
                    <input type="hidden" name="pausable" value="1">                    
                @endif
                <input type="text" id="arreglo" class="form-control" name="arreglo[]">
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
</div><script src="{{ asset('admin/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script>  

console.log("no ha iniciado jq 2");
$(function () {

  function asd(){
    console.log("ultima funcion" );
      $('#next').hide();
    //return preventDefault();
  }

  $('.carousel').carousel({
    interval: 100000, 
    pause: true, 
    wrap: false
  });

  function desabilitar(){
    //return preventDefault();

    console.log("ultimo elemento  y funcion desabilitar" );
      $('#next').hide();
      asd();
      //alert("asd");
  };


  // execute function after sliding:
  $('.carousel').on('slid.bs.carousel', function (e) {
      // This variable contains all kinds of data and methods related to the carousel
      /*function desabilitar(){
        console.log("ultimo elemento  y funcion desabilitar" );
          $('#next').hide();
          alert("asd");
      };*/
      var carouselData = $(this).data('bs.carousel');
      // get current index of active element
      var currentIndex = carouselData.getItemIndex(carouselData.$element.find('.item.active'));
      // hide carousel controls at begin and end of slides
      $(this).children('.carousel-control').show();
      
      if(currentIndex == 0){
          $(this).children('.left.carousel-control').fadeOut();
          e.preventDefault();
          console.log("primera slide");
          $('.carousel').carousel('pause');
          return false; // stay on this slide
          //alert('primero');
      }else if(currentIndex+1  == carouselData.$items.length){
          
          //alert('ultimo');
      }
      console.log('elemento actual: '+currentIndex);
      console.log('numero de preguntas'+$('#numero_preguntas').val());
      //currentIndex+=1;
      if (currentIndex == $('#numero_preguntas').val() -1 ) 
      {
          //$(this).children('.right.carousel-control').fadeOut();
          /*console.log("ultimo elemento  " );
          $('#next').hide();
          alert("asd");*/
          desabilitar();
          //$('#mycarrousel').fadeOut(4000);
      }
      //currentIndex+=1;
  });

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

