@extends('template')
@section('title')
{{ $CAMPAIGN_TITLE }}
@stop
@section('content')

<div class="create_edit">
<div class="panel panel-primary">

    <div class="panel-heading">
        <h3 class="panel-title"><strong>New {{ $CAMPAIGN_TITLE }}</strong></h3>
    </div>

    <div class="panel-body">
        {!! Form::model($campaign = new \App\Campaign, ['action'=>'CampaignController@store']) !!}

            @include('campaign.form')

            <div class="col-md-12">
                <div class="form-group pull-right" style="padding: 30px 190px 0px 0px;">
                    {!! Form::submit('Add', ['class'=> 'btn btn-success']) !!}
                    <a href="/campaign" class="btn btn-default">Cancel</a>            
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
</div>

@stop