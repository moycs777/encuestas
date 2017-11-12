@extends('user.layouts.app2')
@section('content')
<div class="container">
  <br><br><br><br>
    <div class="row">
    <p>categoria  {{ $encuesta->category }} </p>
        <form action="{{ route('encuestas.store') }}" method="post" id="formid"> 
            {{ csrf_field()  }} 
            <input type="hidden" name="poll_id" value="{{ $encuesta->id }}">
            <div class="myform">
                {{-- <input type="hidden" name="respuesta_id[]" value="">     --}}            
            </div>
        <div class="col-md-12 {{-- col-md-offset-2 --}}">
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
                          <div class="col-md-4 col-xs-4">
                              <p>{{  $pregunta->name }}</p>
                          </div>
                          {{-- Respuestas --}}                            
                          <div class="col-md-8 col-xs-6">                              
                          @if (!empty($pregunta->answers))
                            @foreach($pregunta->answers as $answer)
                              @if ($pregunta->multiple_answers == 1)
                                <input type="checkbox" 
                                  name="{{  $pregunta->id }}" 
                                  value="{{ $answer->id }}" 
                                  class="chk" 
                                  id="{{ $answer->id }}"> {{ $answer->name }}
                              @else
                              {{-- @endif  
                              @if ($pregunta->multiple_answers == 0) --}}
                                <input type="radio" 
                                  name="{{  $pregunta->id }}" 
                                  value="{{ $answer->id }}" 
                                  class="rad" 
                                  id="{{ $answer->id }}"> {{ $answer->name }}
                              @endif  
                            @endforeach
                          @endif
                          </div>
                        </div>
                      @endforeach
                    @endif
                </div>
                <input type="submit" value="Registrar encuesta" >
                <button id="evaluar" class="btn btn-danger">Evaluar</button>
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

  $('.chk').click(function(event) {
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

      var suma = 0;
      var selected = 0;    
        $('#formid input[type=checkbox]').each(function(){
            if (this.checked) {
                selected += parseInt($(this).val());
                //console.log("Valor de selected:   " + selected);
                suma += selected;
                console.log("suma:   " + suma);
            }
        }); 

        if (selected != '') 
            console.log('Has seleccionado: '+selected);  
        else
            console.log('Debes seleccionar al menos una opción.');

        //return false;
  });

  $("#evaluar").click(function(){
        $("#listas li").each(function(){
            alert($(this).attr('id'));
        });
  });




 

    

});
</script>

@endsection



