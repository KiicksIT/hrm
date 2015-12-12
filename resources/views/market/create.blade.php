@extends('template')
@section('title')
{{ $MARKET_TITLE }}
@stop
@section('content')

<div class="create_edit">
<div class="panel panel-primary">

    <div class="panel-heading">
        <h3 class="panel-title"><strong>New {{$choice}}</strong></h3>
    </div>

    <div class="panel-body">
        {!! Form::model($market = new \App\Market, ['action'=>'MarketController@store']) !!}

            @if($choice == 'Lead')
                @include('market.form_lead')
            @elseif($choice == 'Prospect')
                @include('market.form_prospect')
            @elseif($choice == 'Closed')
                @include('market.form_closed')
                @include('person.form')
                @include('transaction.form')
            @endif

            <div class="col-md-12">
                <div class="form-group pull-right" style="padding: 30px 190px 0px 0px;">
                    {!! Form::submit('Add', ['name'=>$choice ,'class'=> 'btn btn-success']) !!}
                    <a href="/market" class="btn btn-default">Cancel</a>            
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
</div>

@stop