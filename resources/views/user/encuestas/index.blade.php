@extends('user.layouts.app2')
@section('content')
    <br>    <br>    <br>    <br>
    <!-- Service section -->
    <section id="service">
        <div class="container">
            <div class="row">
            
                <div class="sec-title text-center">
                    <h2 class="wow animated bounceInLeft">Encuestas</h2>
                    {{-- <p class="wow animated bounceInRight">Lista de encuestas</p> --}}
                </div>
                
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            @if (!$polls == null)
                                <div class="table-responsive">                          
                                <table class="table"><tr>
                                    <th>Nombre</th><th></th><th>Categoria</th></tr>
                                    </thead>
                                    <tbody>                          
                                        @foreach ($polls as $item)
                                    <tr>                                
                                        <td class="active"><a href="#">{{ $item->name }}</a></td> 
                                        <td><a href="{{ route('encuestas.show', $item->id) }}">Comenzar</a></td>                            
                                        <td class="success">{{ $item->category_id }}</td>
                                    </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <!-- end Service section -->


        {{-- <br><br><br><br><br>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Encuestas</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (!$polls == null)
                        <div class="table-responsive">                          
                        <table class="table"><tr>
                            <th>Nombre</th><th>Categoria</th></tr>
                            </thead>
                            <tbody>                          
                              @foreach ($polls as $item)
                            <tr>                                
                                <td class="active"><a href="{{ route('encuestas.show', $item->id) }}">{{ $item->name }}</a></td>                             
                                <td class="success">{{ $item->category_id }}</td>
                            </tr>
                              @endforeach
                            </tbody>
                        </table>
                        </div>
                    @endif
                </div>
            </div>
        </div> --}}
  
@endsection