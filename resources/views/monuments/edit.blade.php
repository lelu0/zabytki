@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Dodaj zabytek</h4>
                </div>
                <div class="panel-body">
                    {!! Form::model($monument, ['url' => '/monuments/'.$monument->id, 'method'=>'PUT', 'files' => 'files']) !!}

                    {{Form::label('name', 'Nazwa')}} <br>
                    {{Form::text('name',null,['class'=>'form-control'])}} <br>

                    {{Form::label('category_id', 'Kategoria')}} <br>
                    {{Form::select('category_id',$categories,null,['class'=>'form-control'])}} <br>

                    {{Form::label('short_description', 'Krótki opis (190 znaków)')}} <br>
                    {{Form::textArea('short_description',null,['class'=>'form-control', 'rows' => 2, 'cols' => 40])}} <br>

                    {{Form::label('description', 'Opis')}} <br>
                    {{Form::textArea('description',null,['class'=>'form-control', 'rows' => 4, 'cols' => 40])}} <br>

                    {{Form::label('sources', 'Źródła (rozdzielone średnikiem, w formacie "nazwa|link[opcjonalnie] )')}} <br>                    
                    {{Form::textArea('sources',null,['class'=>'form-control', 'rows' => 4, 'cols' => 40])}} <br>

                    <hr>
                    <p>Wszystkie dane lokalizacyjne są opcjonalne - podaj te, które znasz.</p>
                    {{Form::label('street', 'Ulica i numer')}} <br>
                    {{Form::text('street',null,['class'=>'form-control'])}} <br>

                    {{Form::label('city', 'Miasto')}} <br>
                    {{Form::text('city',null,['class'=>'form-control'])}} <br>

                    {{Form::label('voivodeship', 'Województwo')}} <br>
                    {{Form::text('voivodeship',null,['class'=>'form-control'])}} <br>

                    {{Form::label('postal', 'Kod pocztowy')}} <br>
                    {{Form::text('postal',null,['class'=>'form-control'])}} <br>

                    {{Form::label('country', 'Kraj')}} <br>
                    {{Form::text('country',null,['class'=>'form-control'])}} <br>

                    {{Form::label('latitude', 'Szerokość geograficzna')}} <br>
                    {{Form::number('latitude',null,['class'=>'form-control', 'step' => '0.01'])}} <br>

                    {{Form::label('logitude', 'Długość geograficzna')}} <br>
                    {{Form::number('logitude',null,['class'=>'form-control', 'step' => '0.01'])}} <br>

                    
                    
                    {{Form::label('in_area', 'Lokalizacja przybliżona')}}<br>
                    {{Form::checkbox('in_area',null,['class'=>'form-control'])}}  <br>
                    <hr>

                    {{Form::label('files[]', 'Zdjęcia (można wybrać wiele)')}} <br>
                    {{Form::file('files[]', array('multiple'=>true, 'class' => 'form-control'))}} <br>


                    {{Form::submit('Zapisz',['class' => 'btn btn-primary'])}}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection