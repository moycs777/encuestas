@extends('admin.layouts.app')

@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection

@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
     {{ $encuesta->name }}
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
                    <input type="text" class="form-control" id="name" name="name"
                        placeholder="Pregunta" required>
                     
                    <p class="error text-center alert alert-danger hidden"></p>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary" type="submit" id="add">
                        <span class="glyphicon glyphicon-plus"></span> ADD
                    </button>
                </div>
            </div>
          </div>

          {{-- <div class="table-responsive text-center">
              <table class="table table-borderless" id="table">
                  <thead>
                      <tr>
                          <th class="text-center">#</th>
                          <th class="text-center">Pregunta</th>
                          <th class="text-center">Acciones</th>
                      </tr>
                  </thead>
                  @foreach($preguntas as $item)
                  <tr class="item{{$item->id}}">
                      <td>{{$item->id}}</td>
                      <td>{{$item->name}}</td>
                      <td><button class="edit-modal btn btn-info" data-id="{{$item->id}}"
                              data-name="{{$item->name}}">
                              <span class="glyphicon glyphicon-edit"></span> Editar
                          </button>
                          <button class="delete-modal btn btn-danger" data-id="{{$item->id}}"
                              data-name="{{$item->name}}">
                              <span class="glyphicon glyphicon-trash"></span> Eliminar
                          </button></td>
                  </tr>
                  @endforeach
              </table>
          </div> --}}
         
      		@if (!empty($preguntas))
     		@foreach($preguntas as $item)

           <div class="box-body">
            <table class="table table-bordered">
             <tr>
               <th style="width: 10px">{{ $loop->iteration }}</th>
               <th>{{ $item->name }}</th>
               {{-- <th>Easd</th> --}}
               <th style="width: 20px">Puntos</th>
               <th style="width: 10px">Acciones</th>
             </tr>
             	@if (!empty($item->answers))
     			  @foreach($item->answers as $answer)
		             <tr>
		               <td>{{ $loop->iteration }}</td>
		               <td>{{ $answer->name }}</td>
		               {{-- <td>
		                 <div class="progress progress-xs">
		                   <div class="progress-bar progress-bar-primary" style="width: 55%"></div>
		                 </div>
		               </td> --}}
		               <td><span class="badge bg-light-blue">{{ $answer->value }}</span></td>
		               <td>
		               		<button class="edit-modal btn btn-info" data-id="{{$answer->id}}"
                               data-name="{{$answer->name}}">
                               <span class="glyphicon glyphicon-edit"></span> Edit
                           </button>
                           <button class="delete-modal btn btn-danger" data-id="{{$answer->id}}"
                               data-name="{{$answer->name}}">
                               <span class="glyphicon glyphicon-trash"></span> Delete
                           </button>
		               </td>
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
      <!-- /.box-body -->
      <div class="box-footer">
      </div>
      <!-- /.box-footer-->
    </div>
    <!-- /.box -->
    

  </section>
  <!-- /.content -->

</div>
<!-- /.content-wrapper -->
<div id="myModal" class="modal fade" role="dialog">
<div class="modal-dialog">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">×</button>
      <h4 class="modal-title"></h4>
    </div>
    <div class="modal-body">
      <form class="form-horizontal" role="form">
        <div class="form-group">
          <label class="control-label col-sm-2" for="id">ID:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="fid" disabled>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="name">Name:</label>
          <div class="col-sm-10">
            <input type="name" class="form-control" id="n">
          </div>
        </div>
      </form>
    </div>
      <div class="deleteContent">
        Are you Sure you want to delete <span class="dname"></span> ? <span
          class="hidden did"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn actionBtn" data-dismiss="modal">
          <span id="footer_action_button" class='glyphicon'> </span>
        </button>
        <button type="button" class="btn btn-warning" data-dismiss="modal">
          <span class='glyphicon glyphicon-remove'></span> Close
        </button>
      </div>
    </div>
  </div>
</div>
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

	$( '.edit-modal').on('click', function() {
		console.log("editar");
        $('#footer_action_button').text(" Update");
        $('#footer_action_button').addClass('glyphicon-check');
        $('#footer_action_button').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').addClass('edit');
        $('.modal-title').text('Edit');
        $('.deleteContent').hide();
        $('.form-horizontal').show();
        $('#fid').val($(this).data('id'));
        $('#n').val($(this).data('name'));
        $('#myModal').modal('show');
    });

	$("#add").click(function() {
		//alert(" ");
	 	var url = '{{ route('pregunta.anadir') }}';
	 	var poll_id = {{ $encuesta->id }}
	 	console.log("pregunta " + $('input[name=name]').val() + " , " + "poll_id " + poll_id)

	    $.ajax({
	        type: 'post',
	        url: url,
	        data: {
	            '_token': $('input[name=_token]').val(),
	            'name': $('input[name=name]').val(),
	            'poll_id': poll_id
	        },
	        success: function(data) {
	            if ((data.errors)) {
	                $('.error').removeClass('hidden');
	                $('.error').text(data.errors.name);
	            } else {
	                $('.error').remove();
	                $('#table').append("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.name + "</td><td><button class='edit-modal btn btn-info' data-id='" + data.id + "' data-name='" + data.name + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-name='" + data.name + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
	            }
	        },
	    });
	    $('#name').val('');
    });

    $('.modal-footer').on('click', '.edit', function() {

        $.ajax({
            type: 'post',
            url: '/editItem',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#fid").val(),
                'name': $('#n').val()
            },
            success: function(data) {
                $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.name + "</td><td><button class='edit-modal btn btn-info' data-id='" + data.id + "' data-name='" + data.name + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-name='" + data.name + "' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
            }
        });
    });

});
</script>

@endsection

