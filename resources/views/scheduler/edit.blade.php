@extends('template')
@section('title')
{{ $SCHEDULER_TITLE }}
@stop
@section('content')

<div class="create_edit">
<div class="panel panel-primary">

    <div class="panel-heading">
        <h3 class="panel-title"><strong>Editing {{$scheduler->id}} : {{$scheduler->name}} </strong></h3>
    </div>

    <div class="panel-body">
        {!! Form::model($scheduler,['method'=>'PATCH','action'=>['SchedulerController@update', $scheduler->id]]) !!}            

            @include('scheduler.form_edit')

            <div class="col-md-12">
                <div class="pull-right form_button_right">
                    @if($scheduler->status == 'Pending')
                    {!! Form::submit('Edit', ['class'=> 'btn btn-primary']) !!}
                    @endif
        {!! Form::close() !!}

                    <a href="/scheduler" class="btn btn-default">Cancel</a>            
                </div>
                <div class="pull-left form_button_left">
                    {!! Form::open(['method'=>'DELETE', 'action'=>['SchedulerController@destroy', $scheduler->id], 'onsubmit'=>'return confirm("Are you sure you want to delete?")']) !!}                
                        {!! Form::submit('Delete', ['class'=> 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </div>                
            </div>
    </div>
</div>
</div>

@stop