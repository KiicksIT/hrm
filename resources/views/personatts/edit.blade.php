@extends('template')
@section('title')
{{ $PERSON_TITLE }}
@stop
@section('content')

<div class="create_edit" ng-app="app" ng-controller="personAttsController">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="panel-title pull-left">
                <h3 class="panel-title">Recurring Setup 重复开单设置: {{$person->name}}</h3>
            </div>
        </div>

        <div class="panel-body">
            {!! Form::model($personatts,['method'=>'PATCH','action'=>['PersonAttsController@update', $personatts->id]]) !!}

                {!! Form::hidden('person_id', $person->id, ['id'=>'person_id','class'=>'form-control']) !!}

                @include('personatts.form')

                <div class="col-md-12">
                    <div class="pull-right">
                        {!! Form::submit('Done', ['class'=> 'btn btn-success']) !!}
            {!! Form::close() !!}

                        <a href="/person" class="btn btn-default">Back</a>
                    </div>
                </div>
        </div>
    </div>
</div>

<script src="/js/personatts.js"></script>
@stop
