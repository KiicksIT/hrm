@extends('template')
@section('title')
{{ $MARKET_TITLE }}
@stop
@section('content')

<div class="create_edit">
<div class="panel panel-primary">

    <div class="panel-heading">
        <h3 class="panel-title"><strong>{{$market->name}} - [{{$market->status}}]</strong></h3>
    </div>

    <div class="panel-body">
        {!! Form::model($market) !!} 
            @include('market.form_closed')
            @include('person.form')
            <div class="col-md-12">
            <p class="text-center" style="border-style: groove; padding: 10px 0px 10px 0px">
                <strong>
                    @foreach($market->transaction->items as $index2 => $content)
                    {{$content->name}}
                    @if($index2 + 1 != count($market->transaction->items))
                    ,
                    @endif
                    @endforeach  
                </strong>                      
            </p>
            </div>
            @include('transaction.form')
            <div class="col-md-12">
                <div class="pull-right form_button_right">
                    <a href="/market" class="btn btn-default">Cancel</a>
                </div>               
            </div>              
        </div>              
        {!! Form::close() !!} 
                          
    </div>
</div>
</div>

<script>
    $(":input").attr("disabled", true);
</script>

@stop