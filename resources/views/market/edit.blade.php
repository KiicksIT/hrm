@extends('template')
@section('title')
{{ $MARKET_TITLE }}
@stop
@section('content')

<div class="create_edit">
<div class="panel panel-primary">

    <div class="panel-heading">
        <h3 class="panel-title"><strong>Editing {{$market->name}} - [{{$market->status}}]</strong></h3>
    </div>

    <div class="panel-body">
        {!! Form::model($market,['id'=>'edit', 'method'=>'PATCH','action'=>['MarketController@update', $market->id]]) !!}            
            @if($market->status == 'Lead')
                @include('market.form_lead')
            @elseif($market->status == 'Prospect')
                @include('market.form_prospect')
                </hr>
                @include('person.form')
                </hr>
                @include('transaction.form')
            @elseif($market->status == 'Closed')
                @include('transaction.form')
                @include('person.form')
            @endif
        {!! Form::close() !!}
            <div class="col-md-12">
                <div class="pull-right form_button_right">
                    
                    @if($market->status == 'Lead')
                        {!! Form::submit('Convert Prospect', ['name'=>'edit_lead', 'class'=> 'btn btn-primary', 'form'=>'edit']) !!}
                        {!! Form::submit('Save', ['class'=> 'btn btn-default', 'form'=>'edit']) !!}
                    @elseif($market->status == 'Prospect')
                        {!! Form::submit('Convert Closed', ['name'=>'edit_prospect', 'class'=> 'btn btn-warning', 'form'=>'edit']) !!}
                        {!! Form::submit('Save', ['class'=> 'btn btn-default', 'form'=>'edit']) !!}
                    @endif
                        <a href="/market" class="btn btn-default">Cancel</a>
                    

                </div>
                <div class="pull-left form_button_left">
                    {!! Form::open(['method'=>'DELETE', 'action'=>['MarketController@destroy', $market->id], 'onsubmit'=>'return confirm("Are you sure you want to delete?")']) !!}                
                        {!! Form::submit('Delete', ['class'=> 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </div>                
            </div>
    </div>
</div>
</div>

@stop