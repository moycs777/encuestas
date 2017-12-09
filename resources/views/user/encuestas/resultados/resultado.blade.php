@extends('user.layouts.app2')
@section('content')
    <br>    <br>    <br>    <br>
    <!-- Service section -->
    <section id="service">
        <div class="container">
            <div class="row">
                <div class="sec-title text-center">
                    <h2 class="wow animated bounceInLeft" style="color: #999999;">Encuestas</h2>
                </div>
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <h3 class="text-center">Ya tenemos tu calificacion.</h3>
                            <br>                             
                            <div class="table-responsive">          
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th>Encuesta</th>
                                    <th>Puntaje</th>
                                    <th>Resultado</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>{{ $encuesta->name }}</td>
                                    <td>{{ $total }}</td>
                                    <td>{{ $resume->text }}</td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </section>    
  
@endsection