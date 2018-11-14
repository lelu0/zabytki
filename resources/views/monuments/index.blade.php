@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Zabytki</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach ($monuments as $monument)
                        <h3><a href="/monuments/{{$monument->id}}">{{$monument->name}}</a></h3>
                        <p>{{$monument->location['city']}}, {{$monument->location['country']}}</p>
                        <p>{{$monument->description}}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
