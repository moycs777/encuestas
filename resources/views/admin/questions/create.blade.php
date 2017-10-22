@extends('admin.layouts.app')

@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('admin/css/font-awesome.min.css') }}">
{{--  <link rel="stylesheet" href="{{ url('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css') }}">  --}}
{{-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> --}}
@endsection

@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
     Encuesta: {{ $encuesta->name }}
    </h1>    
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
      </div>
      <div class="box-body">
        <div class="box">
          <div class="box-header">
            {{-- <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modalQuestion">
                Añadir Preguntas
            </button> --}}
            <div class="form-group row add">
                <div class="col-md-8">
                	{{ csrf_field() }}
                  <h1>Preguntas</h1>
                  <a href="#" id="addQuestion" data-toggle="modal" data-target="#questionModal" 
                  class="" data-toggle="tooltip" title="Añdir pregunta!"><i class="fa fa-plus" aria-hidden="true" class="pull-right"></i></a>
                </div>
                
            </div>
          </div>          

          <div id="myDiv">
      		@if (!empty($preguntas))
     		  @foreach($preguntas as $item)
           <div class="box-body">
            <table class="table table-bordered">
             <tr >
               <th style="width: 10px">{{ $loop->iteration }}</th>
               <th class="question" id="{{ $item->id }}" data-toggle="modal" data-target="#questionModal">{{ $item->name }} 
                <input type="hidden" id="question_id" value="{{ $item->id }}">
               </th>
                   
               <th style="width: 20px">
                  <a href="#" id="addAnswer" data-toggle="modal" data-target="#answerModal" data-toggle="tooltip" 
                  title="Añadir respuesta!" value="{{ $item->id }}"><i class="fa fa-plus" ></i>
                  </a>
                  <input type="hidden" id="question_id_answer" value="{{ $item->id }}">
                  
               </th>
               <th style="width: 20px">Puntos</th>
               {{--  <th style="width: 10px">Acciones</th>  --}}
             </tr>
             @if (!empty($item->answers))
     			    @foreach($item->answers as $answer)
		             <tr>
		               <td>-</td>
		               <td class="answer" id="{{ $answer->id }}" data-toggle="modal" data-target="#answerModal">{{ $answer->name }}</td>                   
		               <td></td>		               
                   <td><span class="badge bg-light-blue">{{ $answer->value }}</span></td>		              
		             </tr>
		          @endforeach
		        @endif      
            </table>
            </div>
           <!-- /.box-body -->           

     		@endforeach
	      @endif
        </div>

        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
      </div>
      <!-- /.box-footer-->
    </div>
    <!-- /.box --> 
  </section>
  <!-- /.content -->
</div>

{{-- Qustion modal --}}
<div class="modal fade" id="questionModal" tabindex="-1" role="dialog">
 <div class="modal-dialog" role="document">
   <div class="modal-content">
     <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <h4 class="modal-title" id="title">Pregunta</h4>
     </div>
     <div class="modal-body">
       <input type="text" id="question" name="question" placeholder="Pregunta??" class="form-control">
       <input type="hidden" id="id">
     </div>
     <div class="modal-footer">
       {{-- <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span></button> --}}
       <button type="button" id="delete" style="display: none" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-trash"></span></button>
       <button type="button" id="saveChanges" style="display: none" class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-floppy-disk"></span></button>
       <button type="button" id="add" style="display: none" class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-floppy-disk"></span></button>
     </div>
   </div><!-- /.modal-content -->
 </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

{{-- Answer modal --}}
<div class="modal fade" id="answerModal" tabindex="-1" role="dialog">
 <div class="modal-dialog" role="document">
   <div class="modal-content">
     <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <h4 class="modal-title" id="titleAnswer">Answer</h4>
     </div>
     <div class="modal-body">
       <input type="text" id="answer" name="answer" placeholder="answer" class="form-control">
       <div class="col-xs-2">        
       <input  type="number" id="points" name="points" placeholder="puntos"  class="form-control" min=0>
      </div>
       <input type="hidden" id="id">
       <input type="hidden" id="id_question">
     </div>
     <div class="modal-footer">
       {{-- <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span></button> --}}
       <button type="button" id="deleteAnswer" style="display: none" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-trash"></span></button>
       <button type="button" id="saveChangesAnswer" style="display: none" class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-floppy-disk"></span></button>
       <button type="button" id="saveAnswer" style="display: none" class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-floppy-disk"></span></button>
     </div>
   </div><!-- /.modal-content -->
 </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
@section('footerSection')
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script>	

$(function () {
	/*$("#example1").DataTable();*/
	$("#example1").DataTable( {
	  "pageLength": 100
	});
  console.log("pagina para editar las preguntas y respuestas");
  
  var url = '{{ route('pregunta.anadir') }}';
  var url_delete = '{{ route('pregunta.eliminar') }}';
  var url_update = '{{ route('pregunta.actualizar') }}';
  var poll_id = {{ $encuesta->id }}
  
  $('.question').click(function(){
    console.log("se clickeo un elemento de pregunta");
  });

  $(document).on('click', '.question', function(event) {
    //Modal editar una pregunta
      console.log('editar con modal');
      var id = $(this).find('#question_id').val();
      var question_id = $(this).attr('id');
      var question = $(this).text();
      var question = $.trim(question);
      $('#question').val(question);
      $('#title').text('Editar Pregunta');
      $('#delete').show('400');
      $('#saveChanges').show('400');
      $('#add').hide('400'); 
      $('#id').val(question_id); 

      console.log("id de pregunta: " + question_id + ' , pregunta: ' + question + ' , el id es: ' + id);
  });

  //Modal Añadir pregunta
  $(document).on('click', '#addQuestion', function(event) {
    console.log('modal añadir');
    $('#question').val('');
    $('#add').show('400'); 
    $('#title').text('Añadir Pregunta');
    $('#delete').hide('400');
    $('#saveChanges').hide('400');
    $('#question').val('');

    var question_id = $(this).attr('id');
    var question = $(this).text();
    console.log("id de pregunta: " + question_id);
    $('#question').val(question);   
  });

  //Crear
  $('#add').click(function(event){
    var question = $('#question').val();
    var ope = "c";
    console.log("nombre de pregunta: " + question);
    console.log("id  de la encuesta: " + poll_id);
    $.post(url, 
      {'name' : question, 
      'poll_id' : poll_id, 
      'ope' : ope, 
      '_token' : $('input[name=_token]').val() }, function(data) {
      /*optional stuff to do after success */
      $('#question').val('');
      /*location.reload();*/
      $('#myDiv').load(location.href + ' #myDiv' );
    });

  }); 

  //Borrar
  $('#delete').click(function(event){
    var id = $('#id').val();
    console.log(id);
    $.post(url_delete, {'id': id,
      'poll_id' : poll_id, 
      '_token' : $('input[name=_token]').val() }, function(data) {
      console.log('eliminado el id:' + id + ' ' + data);
      $('#myDiv').load(location.href + ' #myDiv' );
    });
  }); 

  //Actualizar
  $('#saveChanges').click(function(event){
    var id = $('#id').val();
    var question_name = $.trim(($('input[name=question]').val())) ;
    console.log(id + question_name);
    $.post(url_update, {'id': id,
      'name' : question_name,
      '_token' : $('input[name=_token]').val()
      }, function(data) {
      /*optional stuff to do after success */
      $('#myDiv').load(location.href + ' #myDiv' );
    });
    
  }); 

  // Answer  Answer  Answer  Answer  Answer  Answer  Answer  Answer  Answer  Answer  Answer  Answer  Answer  Answer  Answer  Answer
    
    var url_answer = '{{ route('respuesta.anadir') }}';
    var url_delete = '{{ route('respuesta.eliminar') }}';
    var url_update = '{{ route('respuesta.actualizar') }}';
    var poll_id = {{ $encuesta->id }};
    
    $('.answer').click(function(){
      console.log("se clickeo un elemento de answer");
    });
    
    //Modal Añadir answer
    $(document).on('click', '#addAnswer', function(event) {
      console.log('modal añadir answer');
      $('#saveAnswer').show('400'); 
      $('#titleAnswer').text('Añadir Answer');
      $('#deleteAnswer').hide('400');
      $('#saveChangesAnswer').hide('400');
      $('#answer').val('');
      {{--  $.trim($('#answer').val(''));
      $.trim($('#answer').text(''));    --}}    
      //$('#answer').val('');
      $.trim($(this).text());
      //var question_id = $(this).attr('id');
      var question_id = $(this).attr('value');   

      
      var answer = $(this).text();
      $('#question_id_answer').val(question_id);      
      
      $('#answer').val(answer);   
      $('#id_question').val(question_id);      
      console.log("id de pregunta: " + question_id);
    });
  
    //Crear
    $('#saveAnswer').click(function(event){
      var answer = $('#answer').val();
      var points = $('#points').val();
      var ope = "c";
      var id = $('#id_question').val();
           
      console.log("nombre de answer: " + answer);
      console.log("id  : " + id);
      $.post(url_answer, 
        {'name' : answer, 
        'question_id' : id,
        'poll_id' : poll_id,
        'value' : points, 
        'ope' : ope, 
        '_token' : $('input[name=_token]').val() }, function(data) {        
        $('#answer').val('');        
        $('#myDiv').load(location.href + ' #myDiv' );
      });  
  
    });

    //Modal editar una pregunta  
    {{--  $(document).on('click', '.question', function(event) {
      
      console.log('editar con modal');
      var id = $(this).find('#question_id').val();
      var question_id = $(this).attr('id');
      var question = $(this).text();
      var question = $.trim(question);
      $('#question').val(question);
      $('#title').text('Editar Pregunta');
      $('#delete').show('400');
      $('#saveChanges').show('400');
      $('#add').hide('400'); 
      $('#id').val(question_id); 
      console.log("id de pregunta: " + question_id + ' , pregunta: ' + question + ' , el id es: ' + id);
    });  --}}
  
    //Borrar
   {{--   $('#deleteAnswer').click(function(event){
      var id = $('#id').val();
      console.log(id);
      $.post(url_delete, {'id': id,
        'poll_id' : poll_id, 
        '_token' : $('input[name=_token]').val() }, function(data) {
        console.log('eliminado el id:' + id + ' ' + data);
        $('#myDiv').load(location.href + ' #myDiv' );
      });
    });   --}}
  
    //Actualizar
    {{--  $('#saveChangesAnswer').click(function(event){
      var id = $('#id').val();
      var question_name = $.trim(($('input[name=question]').val())) ;
      console.log(id + question_name);
      $.post(url_update, {'id': id,
        'name' : question_name,
        '_token' : $('input[name=_token]').val()
        }, function(data) {
        
        $('#myDiv').load(location.href + ' #myDiv' );
      });
      
    });   --}}

    

});
</script>
<script src="{{ asset('admin/custom/question/answer.js') }}"></script>

@endsection
