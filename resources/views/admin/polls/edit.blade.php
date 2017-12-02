@extends('admin.layouts.app')

@section('main-content')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	  <!-- Content Header (Page header) -->
	  <section class="content-header">
	    <h1>
	      Editar Encuesta
	    </h1>
	    <ol class="breadcrumb">
	      <li><a href="{{ route('polls.index') }}"><i class="fa fa-dashboard"></i> Index</a></li>
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
	          <form role="form" action="{{ route('polls.update', $poll->id) }}" method="post">
		          {{ csrf_field() }}
	              {{ method_field('PUT') }}
	            <div class="box-body">
	            <div class="col-lg-offset-3 col-lg-4">

	              <div class="form-group">
	                <label for="categoria">Categoria</label><br>
	                <select name="category_id" id="" class="form-control">
	                  @foreach ($categories as $item)
	                    <option value="{{$item->id}}">{{$item->name}}</option>
	                  @endforeach
	                </select>	                
	              </div>
	              
	              <div class="form-group">
	                <label for="name">Nombre de la encuesta</label>
	                <input type="text" class="form-control" id="name" name="name" placeholder="Nombre de la encuesta" value="{{ $poll->name }}">
	              </div>

               {{--  <div class="form-group">
					<label for="slug">Mostrar todas las preguntas?</label>
					<br>
					@if ($poll->show_all_questions == 1)
						<input type="radio" name="show_all_questions" id="show_all_questions" value="1" checked="checked"> Si<br>
						<input type="radio" name="show_all_questions" id="show_all_questions" value="0"> No<br>
					@else
						<input type="radio" name="show_all_questions" id="show_all_questions" value="1"> Si<br>
						<input type="radio" name="show_all_questions" id="show_all_questions" value="0" checked="checked"> No<br>
					@endif
				  </div> --}}

	            <div class="form-group">
	              <button type="submit" class="btn btn-primary">Guardar</button>
	              <a href='{{ route('polls.index') }}' class="btn btn-warning">Regresar</a>
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