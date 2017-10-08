@extends('admin.layouts.app')

@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap.css') }}">
<link rel="stylesheet" href="{{ url('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css') }}">
{{-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> --}}
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
                        <span class="glyphicon glyphicon-plus"></span> 
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
               <th>{{ $item->name }} <a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus" aria-hidden="true" class="pull-right"></i></a></th>
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
{{-- modal --}}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <p>One fine body&hellip;</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
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

    

});
</script>

@endsection

