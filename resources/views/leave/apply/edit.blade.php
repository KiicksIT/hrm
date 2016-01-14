@extends('template')
@section('title')
{{ $APPLEAVE_TITLE }}
@stop
@section('content')

<div class="create_edit">
<div class="panel panel-primary">

    <div class="panel-heading">
        <h3 class="panel-title">
            <strong>Viewing Leave : {{$person->name}} ({{$person->department->name}} - {{$person->position->name}})</strong>
        </h3>
    </div>     

    <div class="panel-body">
        {!! Form::model($applyleave,['id'=>'form_submit', 'method'=>'PATCH','action'=>['ApplyLeaveController@update', $applyleave->id]]) !!}
            {!! Form::text('applyleave_id', $applyleave->id, ['id'=>'applyleave_id', 'class'=>'hidden form-control']) !!}            

            @include('leave.apply.form')

            <div class="col-md-12">
                <div class="pull-right form_button_right">
        {!! Form::close() !!} 
                    @can('approve_leave')             
                    {!! Form::submit('Edit', ['name'=>'btn_edit' ,'class'=> 'btn btn-primary', 'form'=>'form_submit']) !!}       
                    @endcan
                    <a href="javascript:history.go(-1)" class="btn btn-default">Cancel</a>            
                </div>
                <div class="pull-left form_button_left">
                    @can('approve_leave')
                    @if($applyleave->status == 'Pending')
                    {!! Form::submit('Approve', ['name'=>'btn_approve', 'class'=> 'btn btn-success', 'form'=>'form_submit']) !!}
                    {!! Form::submit('Reject', ['name'=>'btn_reject' ,'class'=> 'btn btn-danger', 'form'=>'form_submit']) !!}                 
                    @endif
                    @endcan
                </div>                
            </div>
    </div>
</div>
</div>
@stop