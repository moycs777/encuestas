@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
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
                </div>ad
            </div>
        </div>
    </div>
</div>
@endsection