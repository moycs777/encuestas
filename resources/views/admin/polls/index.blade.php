@extends('admin/layouts/app')

@section('title','Poll!')

@section('main-content')
  {{-- lEncuestas --}}
  
  
  
@endsection
@section('footerSection')

<script>
  console.log("Administradores index");
</script>
<script>
  $(function () {
    /*$('#example1').DataTable()*/
    $('#example1').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
@endsection

    