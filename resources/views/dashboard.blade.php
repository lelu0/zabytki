@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" id="dash-head">
                    <ul class="list-inline" id="dash-nav">
                        <li><a href="/dashboard/1">Moje zabytki</a></li>
                        <li><a href="/dashboard/2">Wiadomości</a></li>
                        @if($user->is_admin) <li><a href="/dashboard/3">Moderacja</a></li> @endif
                        @if($user->is_admin) <li><a href="/dashboard/4">Zatwierdzanie</a></li> @endif
                    </ul>
                </div>

                <div class="panel-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif



                    <div class="tab-content">
                        @if($mode == 1)
                        <div id="menu1" class="tab-pane fade in active">
                            <h3>Moje zabytki</h3>
                            <div class="table-responsive">

                                <table class="table calendar-table table-hover">

                                    {{$monuments = $user->monuments()->orderBy('id','DESC')->paginate(10)}}
                                    @foreach ($monuments as $monument)
                                    <tr>
                                        <td><a href="/monuments/{{$monument->id}}">{{$monument->name}}</a></td>
                                        <td><a href="/monuments/{{$monument->id}}/edit">EDYTUJ</a></td>
                                    </tr>
                                    @endforeach

                                </table>
                            </div>
                        </div>
                        @endif
                        @if($mode == 2)
                        <div id="menu2" class="tab-pane fade in active">
                            <h3>Wiadomości</h3>
                            <div class="table-responsive">

                                <table class="table calendar-table table-hover">
                                    <tr>
                                        <th style="width: 20%;">Autor</th>
                                        <th>Tresć</th>
                                        <th style="width: 20%;">
                                        <th>
                                    </tr>
                                    {{$msgs = $user->messages()->paginate(10)}}
                                    @foreach ($msgs as $msg)
                                    <tr>
                                        <td>
                                            <p>{{$msg->sender->name}}</p>
                                        </td>
                                        <td>
                                            <p>{{$msg->content}}</p>
                                        </td>
                                        <td><a href="/home/sendmsg/{{$msg->sender->id}}">ODPISZ</a></td>
                                    </tr>
                                    @endforeach

                                </table>
                            </div>
                        </div>
                        @endif
                        @if($user->is_admin && $mode == 3)
                        <div id="menu3" class="tab-pane fade in active">
                            <h3>Zgłoszone do moderacji</h3>
                            <div class="table-responsive">

                                <table class="table calendar-table table-hover">
                                    <tr>
                                        <th>Zabytek</th>
                                        <th style="width: 20%;">
                                        <th style="width: 20%;">
                                    </tr>
                                    {{$mods = $moderation->paginate(10)}}
                                    @foreach ($mods as $mod)
                                    <tr>
                                        <td><a href='/monuments/{{$mod->monument->id}}'>{{$mod->monument->name}}</a></td>
                                        <td>
                                            {!! Form::open(['action' =>
                                            array('MonumentController@destroy',$mod->monument->id),
                                            'method'=>'DELETE']) !!}

                                            {{Form::submit('Usuń zabytek',['class' => 'btn btn-primary'])}}
                                            {!! Form::close() !!}
                                        </td>
                                        <td><a href="/home/moderate/done/{{$mod->id}}" class="btn btn-primary" role="button">Sprawdzone</a></td>
                                    </tr>
                                    @endforeach

                                </table>
                            </div>
                        </div>
                        @endif

                        @if($user->is_admin && $mode == 4)
                        <div id="menu4" class="tab-pane fade in active">
                            <h3>Do zatwierdzenia</h3>
                            <div class="table-responsive">

                                <table class="table calendar-table table-hover">
                                    <tr>
                                        <th>Zabytek</th>
                                        <th style="width: 20%;">
                                        <th style="width: 20%;">
                                    </tr>
                                    {{$tcs = $toConfirm->paginate(10)}}
                                    @foreach ($tcs as $tc)
                                    <tr>
                                        <td><a href='/monuments/{{$tc->id}}'>{{$tc->name}}</a></td>
                                        <td>
                                            {!! Form::open(['action' => array('MonumentController@destroy',$tc->id),
                                            'method'=>'DELETE']) !!}

                                            {{Form::submit('Usuń zabytek',['class' => 'btn btn-primary'])}}
                                            {!! Form::close() !!}
                                        </td>
                                        <td><a href="/monument/confirm/{{$tc->id}}" class="btn btn-primary" role="button">Zatwierdż</a></td>
                                    </tr>
                                    @endforeach

                                </table>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection