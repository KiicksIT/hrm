@extends('template')
@section('title')
{{ $CAMPAIGN_TITLE }}
@stop
@section('content')

<div class="create_edit">
    <div class="panel panel-primary">

            <div class="panel-heading">
                <h3 class="panel-title"><strong>Event {{$campaign->id}} : {{$campaign->name}} ({{$campaign->status}}) </strong></h3>
            </div>

            <div class="panel-body">
                {!! Form::model($campaign,['method'=>'PATCH','action'=>['CampaignController@update', $campaign->id]]) !!}     
            <div class="col-md-8 col-md-offset-2">
                <div class="form-group">
                    {!! Form::label('name', 'Event Name', ['class'=>'control-label']) !!}
                    {!! Form::text('name', null, ['class'=>'form-control', 'readonly'=>'readonly']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('start_date', 'Start On', ['class'=>'control-label']) !!}
                    {!! Form::text('start_date', null, ['id'=>'start_date', 'class'=>'date form-control', 'readonly'=>'readonly']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('end_date', 'Ended On *', ['class'=>'control-label']) !!}
                    {!! Form::text('end_date', null, ['id'=>'end_date', 'class'=>'date form-control', 'readonly'=>'readonly']) !!}
                </div>    

                <div class="form-group">
                    {!! Form::label('invest', 'Invested ($)', ['class'=>'control-label']) !!}
                    {!! Form::text('invest', null, ['class'=>'form-control', 'readonly'=>'readonly']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('return', 'Return ($) *', ['class'=>'control-label']) !!}
                    {!! Form::text('return', null, ['class'=>'form-control', 'readonly'=>'readonly']) !!}
                </div>      

                <div class="form-group">
                    {!! Form::label('remark', 'Description', ['class'=>'control-label']) !!}
                    {!! Form::textarea('remark', null, ['class'=>'form-control', 'rows'=>'2', 'readonly'=>'readonly']) !!}
                </div> 

                <div class="form-group">
                    {!! Form::label('ror', 'Rate of Return', ['class'=>'control-label']) !!}
                    @if($campaign->return != 0)
                        {!! Form::text('ror', number_format(($campaign->return / $campaign->invest * 100), 2).'%', ['class'=>'form-control', 'readonly'=>'readonly']) !!}
                    @else
                        -
                    @endif
                </div> 
                <div class="form-group">
                    {!! Form::label('timelength', 'Timelength', ['class'=>'control-label']) !!}
                    {!! Form::text('timelength', \Carbon\Carbon::createFromFormat('d-F-Y', $campaign->start_date)->diffInDays(\Carbon\Carbon::createFromFormat('d-F-Y', $campaign->end_date)).' Day(s)', ['class'=>'form-control', 'readonly'=>'readonly']) !!}
                </div>                                  
            </div>

            <div class="col-md-12">
                <div class="pull-right form_button_right">
                    <a href="/campaign" class="btn btn-default">Cancel</a>            
                </div>
                <div class="pull-left form_button_left">
                    {!! Form::open(['method'=>'DELETE', 'action'=>['CampaignController@destroy', $campaign->id], 'onsubmit'=>'return confirm("Are you sure you want to delete?")']) !!}                
                        {!! Form::submit('Delete', ['class'=> 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </div>                
            </div>
    </div>
</div>
</div>

@stop    

