@extends('template')
@section('title')
{{ $APPLEAVE_TITLE }}
@stop
@section('content')

<div class="create_edit">
<div class="panel panel-primary">

    <div class="panel-heading">
        <h3 class="panel-title"><strong>Apply Leave : {{$person->name}} ({{$person->position->name}}) </strong></h3>
    </div>

    <div class="panel-body">
        {!! Form::model($applyleave = new \App\ApplyLeave, ['action'=>'ApplyLeaveController@store']) !!}

            @include('leave.apply.form')

            <div class="col-md-12">
                <div class="form-group pull-right" style="padding: 20px 190px 0px 0px;">
                    {!! Form::submit('Send', ['class'=> 'btn btn-success']) !!}
                    <a href="/applyleave" class="btn btn-default">Cancel</a>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
</div>

@stop