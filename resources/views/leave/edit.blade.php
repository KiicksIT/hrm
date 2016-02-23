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

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><strong>Attachments</strong></h3>
    </div>

    <div class="panel-body">
        <table class="table table-list-search table-hover table-bordered">
            <tr style="background-color: #DDFDF8">
                <th class="col-md-1 text-center">
                    #
                </th>                    
                <th class="col-md-4 text-center">
                    Item                           
                </th>
                <th class="col-md-3 text-center">
                    Remark
                </th>
                <th class="col-md-2 text-center">
                    Upload On                      
                </th>
                <th class="col-md-2 text-center">
                    Action
                </th>                                                                                                
            </tr>

            <tbody>

                <?php $index = $leaveattaches->firstItem(); ?>
                @unless(count($leaveattaches)>0)
                <td class="text-center" colspan="7">No Records Found</td>
                @else
                @foreach($leaveattaches as $leaveattach)
                <tr>
                    <td class="col-md-1 text-center">{{ $index++ }} </td>
                    <td class="col-md-4">
                        <a href="{{$leaveattach->path}}">
                            {!! Html::image($leaveattach->path, 'alt', array( 'width' => 200, 'height' => 200 )) !!}
                        </a>                            
                    </td>
                    <td class="col-md-3 text-center">{{$leaveattach->remark}}</td>
                    <td class="col-md-2 text-center">{{$leaveattach->created_at}}</td>
                    <td class="col-md-2 text-center">
                        {!! Form::open(['method'=>'DELETE', 'action'=>['LeaveController@removeLeaveAttach', $leaveattach->id], 'onsubmit'=>'return confirm("Are you sure you want to delete?")']) !!}                
                            {!! Form::submit('Delete', ['class'=> 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!} 
                    </td>
                </tr>
                @endforeach
                @endunless                        

            </tbody>
        </table>        
    </div>

    <div class="panel-footer">
        <div class="col-md-10 col-md-offset-1">
        {!! Form::model($leaveattach = new \App\LeaveAttach,['action'=>['LeaveController@addLeaveAttach', $leave->id], 'files'=>true]) !!}
            <div class="form-group">
                {!! Form::label('remark', 'Add Attachment Remark', ['class'=>'control-label']) !!}
                {!! Form::textarea('remark', null, ['class'=>'form-control', 'rows'=>'2']) !!}
            </div> 
            <div class="form-group">
            {!! Form::file('leave_attach', ['class' => 'field']) !!}
            </div>  
            {!! Form::submit('Create', ['class'=> 'btn btn-success pull-right']) !!}  
        {!! Form::close() !!} 
        </div>        
    </div>
</div>

</div>

@stop