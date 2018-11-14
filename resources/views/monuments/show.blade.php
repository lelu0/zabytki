@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>{{$monument->name}}</h4></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                        @if(!empty($monument->location['street']) || !empty($monument->location['postal']) || !empty($monument->location['city']))
                            <h3>Lokalizacja</h3>
                            <p>{{$monument->location['street']}}, {{$monument->location['postal']}} {{$monument->location['city']}} </p>
                            <p>{{$monument->location['voivodeship']}}, {{$monument->location['country']}}</p>
                        @endif
                        <p>Położenie: {{$monument->location['latitude']}};{{$monument->location['logitude']}}</p>
                        <h3>Opis</h3>
                        <p>{{$monument->description}}</p>
                </div>
            </div>
            @if(!empty($monument->comments))
            <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Komentarze</h4>
                    </div>
                    <div class="panel-body">
                        <center>{{$comments = $monument->comments()->paginate(5)}}</center>
                        @foreach($comments as $comment)
                        <p>{{$comment->created_at}} {{$comment->user->name}}    </p>
                        <p>{{$comment->content}}</p>
                        <hr>
                        @endforeach

                        <p>Dodaj komentarz:</p>
                        {!! Form::open(['action' => 'MonumentController@addComment', 'method'=>'POST']) !!}
                        {!! Form::hidden('monument_id', $monument->id) !!}
                        {{Form::textArea('text',null,['class'=>'form-control', 'rows' => 2, 'cols' => 40])}} <br>
                        {{Form::submit('Dodaj',['class' => 'btn btn-primary'])}}
                        {!! Form::close() !!}
                    </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
