@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                <h4>Wyślij wiadomość użytkownikowi {{$user->name}}</h4>
                </div>
                <div class="panel-body">
                    {!! Form::open(['action' => array('HomeController@send',$user->id),  'method'=>'POST']) !!}

                    {{Form::label('topic', 'Temat')}} <br>
                    {{Form::text('topic',null,['class'=>'form-control'])}} <br>

                    {{Form::label('content', 'Treść')}} <br>
                    {{Form::textArea('content',null,['class'=>'form-control', 'rows' => 4, 'cols' => 40])}} <br>

                    {{Form::submit('Wyślij',['class' => 'btn btn-primary'])}}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection