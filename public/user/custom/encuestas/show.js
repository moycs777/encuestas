console.log("no ha iniciado jq");
$(function () {
    
  console.log("regitrar encuestas");
  
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

 

    

});