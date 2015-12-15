@inject('items', 'App\Item')

@extends('template')
@section('title')
{{ $REPORT_TITLE }}
@stop
@section('content')
    
    <div class="row">        
    <a class="title_hyper pull-left" href="/report"><h1>{{ $REPORT_TITLE }} <i class="fa fa-file-text-o"></i></h1></a>
    </div>

            <div class="panel panel-warning">
                <div class="panel-heading">
                        <ul class="nav nav-pills nav-justified" role="tablist">
                            <li class="active"><a href="#person" role="tab" data-toggle="tab">Customer</a></li>
                            <li><a href="#item" role="tab" data-toggle="tab">Product</a></li>
                            <li><a href="#transaction" role="tab" data-toggle="tab">Transaction</a></li>
                            <li><a href="#campaign" role="tab" data-toggle="tab">Event</a></li>
                        </ul>
                </div>

                <div class="panel-body">
                    <div class="tab-content">
                        {{-- first content --}}
                        <div class="tab-pane active" id="person">                        
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                </div>
                                <div class="panel-body">
                                    <div class="col-md-8 col-md-offset-2">
                                        <div class="form-group">
                                        {!! Form::label('cust_choice', 'Select Customer', ['class'=>'control-label']) !!}
                                        {!! Form::open(['id'=>'person_form', 'method'=>'POST','action'=>['RptController@generatePerson']]) !!}
                                                {!! Form::select('cust_choice', [
                                                ''=>'',
                                                'current'=>'Current', 
                                                'lead'=>'Lead', 
                                                'prospect'=>'Prospect'
                                                ],
                                                null, ['class'=>'select form-control', 'id'=>'cust_choice']) !!}
                                        {!! Form::close() !!}
                                        </div>
                                        
                                        {!! Form::submit('Generate', ['class'=> 'btn btn-primary', 'form'=>'person_form']) !!} 
                                     </div>      
                                </div>
                            </div>
                        </div>
                        {{-- second content --}}
                        <div class="tab-pane" id="item">                        
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                </div>
                                <div class="panel-body">
                                    <div class="col-md-8 col-md-offset-2">
                                        {!! Form::open(['id'=>'item_form', 'method'=>'POST','action'=>['RptController@generateItem']]) !!}
                                        
                                        <div class="form-group">
                                        {!! Form::label('services', 'Report of', ['class'=>'control-label']) !!}
                                        {!! Form::select('item_choice', [null=>'','0'=>'All']+$items::lists('name','id')->all(), null, ['class'=>'select form-control']) !!}
                                        </div>
                                       
                                        <div class="col-md-4">
                                        {!! Form::label('item_datefrom', 'Dates between', ['class'=>'control-label']) !!}
                                        {!! Form::text('item_datefrom', null, ['id'=>'item_datefrom', 'class'=>'date form-control']) !!}
                                        </div>

                                        <div class="col-md-1 text-center">
                                        <br>
                                        {!! Form::label('and', 'To', ['class'=>'control-label', 'style'=>'margin-top: 10px;']) !!}
                                        </div>

                                        <div class="col-md-4">
                                        <br>
                                        {!! Form::text('item_dateto', null, ['id'=>'item_dateto', 'class'=>'date form-control', 'style'=>'margin-top: 10px;']) !!}
                                        </div> 

                                        {!! Form::close() !!}

                                        <div class="col-md-12" style="padding-top: 20px">
                                        {!! Form::submit('Generate', ['class'=> 'btn btn-primary', 'form'=>'item_form']) !!}
                                        </div>
                                    </div>    
                                </div>
                            </div>
                        </div>
                        {{-- third content --}}
                        <div class="tab-pane" id="transaction">                        
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                </div>
                                <div class="panel-body">
                                    <div class="col-md-8 col-md-offset-2">
                                        {!! Form::open(['id'=>'transaction_form', 'method'=>'POST','action'=>['RptController@generateTransaction']]) !!}
                                        
                                        <div class="row">
                                           <div class="form-group">
                                                {!! Form::radio('choice_transac', 'tran_specific', 'tran_specific') !!}
                                                {!! Form::label('tran_specific', 'Specific') !!}
                                           </div>

                                           <div class="desc" id="tran_specific">
                                           <div class="col-md-4">
                                                {!! Form::label('transaction_datefrom', 'Dates between', ['class'=>'control-label']) !!}
                                                {!! Form::text('transaction_datefrom', null, ['id'=>'transaction_datefrom', 'class'=>'date form-control']) !!}
                                           </div>

                                           <div class="col-md-1 text-center">
                                           <br/>
                                                {!! Form::label('and', 'To', ['class'=>'control-label', 'style'=>'margin-top: 10px;']) !!}
                                           </div>

                                           <div class="col-md-4">
                                           <br/>
                                                {!! Form::text('transaction_dateto', null, ['id'=>'transaction_dateto', 'class'=>'date form-control', 'style'=>'margin-top: 10px;']) !!}
                                           </div>
                                           </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                           <div class="form-group">
                                                {!! Form::radio('choice_transac', 'tran_all') !!}
                                                {!! Form::label('tran_all', 'By Year') !!}
                                           </div>

                                           <div class="desc col-md-12" id="tran_all">
                                               <select id="transac_year" name="transac_year" class="select">
                                                    <option value="{{Carbon\Carbon::now()->year}}">{{Carbon\Carbon::now()->year}}</option>
                                                    <option value="{{Carbon\Carbon::now()->subYear()->year}}">{{Carbon\Carbon::now()->subYear()->year}}</option>
                                               </select>
                                           </div>
                                        </div>
                                        <br/>

                                        <div class="row">
                                        <div class="form-group">
                                        {!! Form::radio('choice_transac', 'tran_month') !!}
                                        {!! Form::label('tran_month', 'By Month') !!}
                                        </div>

                                       <div class="desc col-md-12" id="tran_month">
                                            <select id="transac_month" name="transac_month" class="select">
                                            @for($i=1; $i<=Carbon\Carbon::now()->month; $i++)
                                                <option value="{{$i}}">{{date("F", mktime(0, 0, 0, $i, 10))}} {{Carbon\Carbon::now()->subYear()->year}}</option>
                                            @endfor
                                            </select>
                                       </div>                            
                                        </div>
                                        <br/>

                                        {!! Form::close() !!}

                                        <div class="col-md-12" style="padding-top: 20px">
                                        {!! Form::submit('Generate', ['class'=> 'btn btn-primary', 'form'=>'transaction_form']) !!}
                                        </div>
                                    </div>    
                                </div>
                            </div>
                        </div>  
                        {{-- fourth content--}}
                        <div class="tab-pane" id="campaign">                        
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                </div>
                                <div class="panel-body">
                                    <div class="col-md-8 col-md-offset-2">
                                        {!! Form::open(['id'=>'campaign_form', 'method'=>'POST','action'=>['RptController@generateCampaign']]) !!}

                                        <div class="row form-group">
                                               <div class="col-md-3">
                                               {!! Form::radio('campaign_choice', 'inprogress') !!}
                                               {!! Form::label('campaign_choice', 'Pending') !!}
                                               </div>

                                               <div class="col-md-3">
                                               {!! Form::radio('campaign_choice', 'done') !!}
                                               {!! Form::label('campaign_choice', 'Complete') !!}
                                               </div>

                                               <div class="col-md-3">
                                               {!! Form::radio('campaign_choice', 'campaign_choice', 'all') !!}
                                               {!! Form::label('campaign_choice', 'All') !!}
                                               </div>
                                        </div>             
                                        {!! Form::close() !!}

                                        
                                        {!! Form::submit('Generate', ['class'=> 'btn btn-primary', 'form'=>'campaign_form', 'style'=>'margin-top:10px']) !!} 
                                     </div>      
                                </div>
                            </div>
                        </div>
                        {{-- end of content--}}
                    </div>
                </div>
            </div>


<script>
    $('.select').select2({'placeholder':'Select...'});

    $('.date').datetimepicker({
        format: 'DD-MMMM-YYYY'
    });  

$(document).ready(function() {
    $('#tran_all').hide();
    $('#tran_month').hide();
    $("input[name$='choice_transac']").click(function() {
        var test = $(this).val();
        $("div.desc").hide();
        $('#'+test).show();
    });
});  

    $(function() {
        // for bootstrap 3 use 'shown.bs.tab', for bootstrap 2 use 'shown' in the next line
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            // save the latest tab; use cookies if you like 'em better:
            localStorage.setItem('lastTab', $(this).attr('href'));
        });
        // go to the latest tab, if it exists:
        var lastTab = localStorage.getItem('lastTab');
        if (lastTab) {
            $('[href="' + lastTab + '"]').tab('show');
        }
    });     
</script>
@stop
