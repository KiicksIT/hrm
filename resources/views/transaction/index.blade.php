@extends('template')
@section('title')
{{ $TRANS_TITLE }}
@stop
@section('content')
    <div class="col-sm-6">
    <div class="row">        
    <a class="title_hyper pull-left" href="/transaction"><h1>{{ $TRANS_TITLE }} <i class="fa fa-credit-card"></i></h1></a>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="pull-right">
                <a href="/transaction/create" class="btn btn-success">+ New {{ $TRANS_TITLE }}</a>                          
            </div>
        </div>

        <div class="panel-body">
            {{-- Search elements --}}

          {{--   <div class="col-md-12" style="padding-bottom: 10px">
                <label for="search_name" class="col-md-2" style="padding-top:0px">Search Name:</label>
                {!! Form::open(['method'=>'GET']) !!}
                {!! Form::input('search', 'name', null, ['class'=>'col-md-2']) !!}
                {!! Form::close() !!}
                <label for="search_name" class="col-md-2" style="padding: 0px 0px 0px 20px">Contract End:</label>
                {!! Form::open(['method'=>'GET']) !!}
                {!! Form::input('search', 'contract_end', null, ['class'=>'col-md-2']) !!}
                {!! Form::close() !!}                  
            </div> --}}

            <div class="table-responsive col-md-12">
                <table class="table table-list-search table-hover table-bordered">
                    <tr style="background-color: #DDFDF8">        
                    <th class="col-md-1 text-center">#</th>
                    <th class="col-md-3">{{ $ITEM_TITLE }} Purchased</th>
                    <th class="col-md-2 text-center">Amount</th>
                    <th class="col-md-2">Customer Name</th>
                    <th class="col-md-1">{!! sort_person('created_at', 'Created On') !!}</th>
                    <th class="col-md-1">{!! sort_person('contract_end', 'Contract End') !!}</th>
                    <th class="col-md-2">Action</th>  
                    </tr>
                    <tbody>
                        <?php $index = $transactions->firstItem(); ?>
                        @unless(count($transactions)>0)
                            <tr>
                            <td colspan="7" class="text-center">No Records Found</td>
                            </tr>
                        @else
                            @foreach($transactions as $transaction)
                            <tr>
                                <td class="col-md-1">{{ $index++ }}</td>
                                <td class="col-md-3">
                                    @foreach($transaction->items as $index2 => $item)
                                    {{$item->name}}
                                        @if($index2 + 1 != count($transaction->items))
                                        ,
                                        @endif
                                    @endforeach
                                </td>
                                <td class="col-md-2 text-right">{{$transaction->amount}}</td>
                                <td class="col-md-2">
                                    <a href="/person/{{$transaction->person->id}}">
                                    {{$transaction->person->company}} - {{$transaction->person->name}}
                                    </a>
                                </td>
                                <td class="col-md-1">{{$transaction->created_at}}</td>
                                <td class="col-md-1">{{$transaction->contract_end}}</td>
                                <td class="col-md-2">
                                    <a href="/transaction/{{ $transaction->id }}/edit" class="btn btn-sm btn-primary col-md-4" style="margin-right:5px;">Edit</a>

                                    {!! Form::open(['method'=>'DELETE', 'action'=>['TransactionController@destroy', $transaction->id], 'onsubmit'=>'return confirm("Are you sure you want to delete?")']) !!}                
                                        {!! Form::submit('Delete', ['class'=> 'btn btn-danger btn-sm col-md-5']) !!}
                                    {!! Form::close() !!}                          
                                </td>                             
                            </tr>
                            @endforeach
                        @endunless
                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel-footer">
            {!! $transactions->render() !!}

            <label class="pull-right totalnum" for="totalnum">
                Total of {{$transactions->total()}} entries
            </label>
        </div>
    </div>
    </div>
 
@stop