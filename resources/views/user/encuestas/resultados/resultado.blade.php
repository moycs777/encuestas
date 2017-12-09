@extends('user.layouts.app2')
@section('content')
    <br>    <br>    <br>    <br>
    <!-- Service section -->
    <section id="about" >
        <div class="container">
            <div class="row">
                
                <div class="col-md-12 {{-- col-md-offset-1 wow animated fadeInRight --}}">
                    <div class="welcome-block">
                        {{-- <h3 class="text-center">Ya tenemos tu calificacion.</h3> --}} 
                        <div class="sec-title text-center">
                            <h2 class="wow animated bounceInLeft">Ya tenemos tu calificacion.</h2>
                        </div>                               
                         <div class="message-body">
                            {{-- <img src="{{ asset('img/member-1.jpg') }}" class="pull-left" alt="member"> --}}
                            <h3>Tu puntaje fue: <strong>{{ $total }}</strong>, en la encuesta: <strong>{{ $encuesta->name }}</strong>.</h3>                           
                            <h3>
                                @if (!$resume==null)
                                    {{ $resume->text }}.
                                @endif
                            </h3>
                         </div>
                    </div>                     
                </div>
                <div class="col-xs-12">
                    <div class="text-center">
                        <a href="{{ url('/') }}" class="btn btn-border btn-effect  {{-- pull-right --}}">Inicio</a>
                        <br><br>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end about section -->
  
@endsection