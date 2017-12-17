@extends('user.layouts.app2')

@push('styles')
<link rel="stylesheet" href="{{ asset('OwlCarousel2-2.2.1\dist\assets/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('OwlCarousel2-2.2.1\dist\assets/owl.theme.default.min.css') }}">
@endpush

@section('content')
<div class="container">
  <br><br><br><br>

    <div id="rootwizard" class="tabbable tabs-left">

       <div id="rootwizard">
      <div class="navbar">
        <div class="navbar-inner">
          <div class="container">
      <ul>
          <li><a href="#tab1" data-toggle="tab">First</a></li>
        <li><a href="#tab2" data-toggle="tab">Second</a></li>
        <li><a href="#tab3" data-toggle="tab">Third</a></li>
        <li><a href="#tab4" data-toggle="tab">Forth</a></li>
        <li><a href="#tab5" data-toggle="tab">Fifth</a></li>
        <li><a href="#tab6" data-toggle="tab">Sixth</a></li>
        <li><a href="#tab7" data-toggle="tab">Seventh</a></li>
      </ul>
       </div>
        </div>
      </div>

      @foreach ($preguntas->chunk(3) as $chunk)
            @foreach ($chunk as $product)
                <div class="col-xs-4">{{ $product->name }}</div>
            @endforeach

        <div class="tab-content">

            @foreach ($chunk as $product)
                <div class="tab-pane" id="tab1">
                  {{ $product->name }}
                </div>
            @endforeach

          <ul class="pager wizard">
            <li class="previous first" style="display:none;"><a href="#">First</a></li>
            <li class="previous"><a href="#">Previous</a></li>
            <li class="next last" style="display:none;"><a href="#">Last</a></li>
              <li class="next"><a href="#">Next</a></li>
          </ul>
        </div>
    @endforeach



    </div>
        

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

  $('#rootwizard').bootstrapWizard();
  
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


