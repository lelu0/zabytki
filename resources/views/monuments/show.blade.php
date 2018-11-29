@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>{{$monument->name}}</h4>
                    <p>Kategoria: {{$monument->category->name}}</p>
                </div>

                <div class="panel-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    
                    <h3>Lokalizacja</h3>
                    <p>{{$monument->location['street']}} </p>
                    <p>{{$monument->location['postal']}} {{$monument->location['city']}} </p>
                    <p>{{$monument->location['voivodeship']}} {{$monument->location['country']}}</p>
                    <p>Położenie: {{$monument->location['latitude']}}, {{$monument->location['logitude']}}</p>
                    @if($monument->in_area)
                    <i>
                        <p>Lokalizacja może być przybliżona</p>
                    </i>
                    @endif
                    
                    <h3>Opis</h3>
                    <p>{{$monument->description}}</p>
                    <hr>
                    <a href="/home/sendmsg/{{$monument->user->id}}">Wyślij wiadomość do autora wpisu</a><br>
                    <a href="/home/moderate/{{$monument->id}}">Zgłoś do moderacji</a>
                </div>
            </div>
            @if(!$monument->sources->isEmpty())
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Źródła</h4>
                </div>
                <div class="panel-body">
                    @foreach($monument->sources as $source)
                    <p><i>{{$source->source}}</i></p>
                    @if(!empty($source->link))
                    <a href={{$source->link}}>Przejdź</a>
                    @endif
                    <hr>
                    @endforeach


                </div>
            </div>
            @endif

            @if(!$monument->photos->isEmpty())
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Zdjęcia</h4>
                </div>
                <div class="panel-body">
                    <center>{{$photos = $monument->photos()->paginate(1)}}</center>
                    @foreach($photos as $photo)
                    <img src="../{{$photo->file_name}}" class="monument_image">

                    @endforeach

                </div>
            </div>
            @endif

            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Komentarze</h4>
                </div>
                <div class="panel-body">
                    <center>{{$comments = $monument->comments()->paginate(5)}}</center>
                    @foreach($comments as $comment)
                    <p>{{$comment->created_at}} {{$comment->user->name}} </p>
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
        </div>
    </div>
</div>
@endsection