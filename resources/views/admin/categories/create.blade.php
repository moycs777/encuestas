@extends('admin.layouts.app')

@section('main-content')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	  <!-- Content Header (Page header) -->
	  <section class="content-header">
	    <h1>
	      Categorias
	      <small>para las encuestas</small>
	    </h1>
	    <ol class="breadcrumb">
	      <li><a href="{{ route('categories.index') }}"><i class="fa fa-dashboard"></i> Index</a></li>
	    </ol>
	  </section>

	  <!-- Main content -->
	  <section class="content">
	    <div class="row">
	      <div class="col-md-12">
	        <!-- general form elements -->
	        <div class="box box-primary">
	          <div class="box-header with-border">
	          </div>
	    	@include('includes.messages')      
	          <!-- /.box-header -->
	          <!-- form start -->
	          <form role="form" action="{{ route('categories.store') }}" method="post">
	          {{ csrf_field() }}
	            <div class="box-body">
	            <div class="col-lg-offset-3 col-lg-2">
	              <div class="form-group">
	                <label for="name">Nombre de la categoria</label>
	                <input type="text" class="form-control" id="name" name="name" placeholder="Nombre de la categoria">
	              </div>

	              <div class="form-group">
	                <label for="slug">Es pausable la encuesta?</label>
	                <br>
	                <input type="radio" name="pausable" value="1" checked="checked" > Si<br>
	                 <input type="radio" name="pausable" value="0"> No<br>
	              </div>

	            <div class="form-group">
	              <button type="submit" class="btn btn-primary">Guardar</button>
	              <a href='{{ route('categories.index') }}' class="btn btn-warning">Regresar</a>
	            </div>
	            	
	            </div>
					
				</div>

	          </form>
	        </div>
	        <!-- /.box -->

	        
	      </div>
	      <!-- /.col-->
	    </div>
	    <!-- ./row -->
	  </section>
	  <!-- /.content -->
	</div>
	<!-- /.content-wrapper -->
@endsection