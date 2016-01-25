@extends('template')
@section('title')
{{ $LEAVE_TITLE }}
@stop
@section('content')

<div class="create_edit">
<div class="panel panel-primary">

    <div class="panel-heading">
        <h3 class="panel-title"><strong>New {{ $LEAVE_TITLE }}</strong></h3>
    </div>

    <div class="panel-body">
        {!! Form::model($leave = new \App\Leave, ['action'=>'LeaveController@store']) !!}

            @include('leave.form')

            <div class="col-md-12">
                <div class="form-group pull-right">
                    {!! Form::submit('Add', ['class'=> 'btn btn-success']) !!}
                    <a href="/leave" class="btn btn-default">Cancel</a>            
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
</div>

@stop