@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
            <div class="col-md-3">
                    <div class="panel panel-default ">
                            <div class="panel-heading">Wyszukaj</div>
                        <div class="panel-body">
                            {!! Form::open(['action' => 'MonumentController@search', 'method'=>'POST']) !!}
                                {{Form::label('name', 'Nazwa')}} <br>
                                {{Form::text('name',null,['class'=>'form-control'])}} <br>
    
                                {{Form::label('category_id', 'Kategoria')}} <br>
                                {{Form::select('category_id',$categories,null,['placeholder' => 'Kategoria','class'=>'form-control'])}} <br>
    
                                {{Form::label('city', 'Miasto')}} <br>
                                {{Form::text('city',null,['class'=>'form-control'])}} <br>
    
                                {{Form::submit('Szukaj',['class' => 'btn btn-primary'])}}
                                <a href="/monuments" class="btn btn-info">Wyczyść</a>
                            </div>
                            {!! Form::close() !!}
                        </div>
            </div>
        <div class="col-md-8">
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
                    <p>{{$monument->location['city']}} </p>
                    <p>{{$monument->location['country']}}</p>
                    <p>{{$monument->short_description}}</p>
                    @endforeach
                    {{$monuments->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection