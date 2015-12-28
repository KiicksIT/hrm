@extends('template')
@section('title')
{{ $LEAVE_TITLE }}
@stop
@section('content')

<div class="create_edit">
<div class="panel panel-primary">

    <div class="panel-heading">
        <h3 class="panel-title"><strong>Editing Leave for {{$leave->person->name}} </strong></h3>
    </div>

    <div class="panel-body">
        {!! Form::model($leave,['method'=>'PATCH','action'=>['LeaveController@update', $leave->id]]) !!}            

            @include('leave.form')

            <div class="col-md-12">
                <div class="pull-right form_button_right">
                    {!! Form::submit('Edit', ['class'=> 'btn btn-primary']) !!}
        {!! Form::close() !!}

                    <a href="/leave" class="btn btn-default">Cancel</a>            
                </div>
                <div class="pull-left form_button_left">
                    @can('delete_user')
                    {!! Form::open(['method'=>'DELETE', 'action'=>['LeaveController@destroy', $leave->id], 'onsubmit'=>'return confirm("Are you sure you want to delete?")']) !!}                
                        {!! Form::submit('Delete', ['class'=> 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                    @endcan
                </div>                
            </div>
    </div>
</div>
</div>

@stop