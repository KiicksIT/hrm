@extends('template')
@section('title')
{{ $PERSON_TITLE }}
@stop
@section('content')

<div class="create_edit">
<div class="panel panel-primary">

    <div class="panel-heading">
        <h3 class="panel-title"><strong>Profile for {{$person->id}} : {{$person->company}} - {{$person->name}} </strong></h3>
    </div>

    <div class="panel-body">
        {!! Form::model($person,['method'=>'PATCH','action'=>['PersonController@update', $person->id]]) !!}            

            @include('person.form')

            <div class="col-md-12">
                <div class="pull-right">
                    {!! Form::submit('Edit Profile', ['class'=> 'btn btn-primary']) !!}
        {!! Form::close() !!}

                    <a href="/person" class="btn btn-default">Cancel</a>            
                </div>
                <div class="pull-left">
                    {!! Form::open(['method'=>'DELETE', 'action'=>['PersonController@destroy', $person->id], 'onsubmit'=>'return confirm("Are you sure you want to delete?")']) !!}                
                        {!! Form::submit('Delete', ['class'=> 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </div>                
            </div>
    </div>
</div>
{{-- second content --}}

    <div class="panel panel-primary">
        <div class="panel-heading">
        <h3 class="panel-title pull-left" style="padding-top:5px"><strong>Transaction History for {{$person->id}} : {{$person->company}} - {{$person->name}} </strong></h3>
            <div class="pull-right">
                <a href="/transaction/create/{{$person->id}}" class="btn btn-md btn-success">+ New {{ $TRANS_TITLE }}</a>                          
            </div>
        </div>

        <div class="panel-body">
            <div class="table-responsive col-md-12">
                <table class="table table-list-search table-hover table-bordered">
                    <tr style="background-color: #DDFDF8">        
                    <th class="col-md-1 text-center">#</th>
                    <th class="col-md-3">{{ $ITEM_TITLE }} Purchased</th>
                    <th class="col-md-2 text-center">Amount</th>
                    <th class="col-md-1 text-center">Created On</th>
                    <th class="col-md-1 text-center">Contract End</th>
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
                                <td class="col-md-1 text-center">{{ $index++ }}</td>
                                <td class="col-md-3">
                                    @foreach($transaction->items as $index2 => $item)
                                    {{$item->name}}
                                        @if($index2 + 1 != count($transaction->items))
                                        ,
                                        @endif
                                    @endforeach
                                </td>
                                <td class="col-md-2 text-right">{{$transaction->amount}}</td>
                                <td class="col-md-2 text-center">{{$transaction->created_at}}</td>
                                <td class="col-md-2 text-center">{{$transaction->contract_end}}</td>
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
                Total of {{count($transactions)}} entries
            </label>
        </div>
    </div>

{{-- third content --}}
<div class="panel panel-primary">
    <div class="panel-heading">
        <div class="panel-title">
            <h3 class="panel-title"><strong>File : {{$person->company}} - {{$person->name}}</strong></h3>
        </div>
    </div>

    <div class="panel-body">
        <table class="table table-list-search table-hover table-bordered">
            <tr style="background-color: #DDFDF8">
                <th class="col-md-1 text-center">
                    #
                </th>                    
                <th class="col-md-7 text-center">
                    Path                           
                </th>
                <th class="col-md-2 text-center">
                    Upload On                      
                </th>
                <th class="col-md-2 text-center">
                    Action
                </th>                                                                                                
            </tr>

            <tbody>

                <?php $index = $files->firstItem(); ?>
                @unless(count($files)>0)
                <td class="text-center" colspan="7">No Records Found</td>
                @else
                @foreach($files as $file)
                <tr>
                    <td class="col-md-1 text-center">{{ $index++ }} </td>
                    <td class="col-md-7">
                        <a href="{{$file->path}}">
                        {!! str_replace("/person_asset/file/", "", "$file->path"); !!}
                        </a>                            
                    </td>
                    <td class="col-md-2 text-center">{{$file->created_at}}</td>
                    <td class="col-md-2 text-center">
                        {!! Form::open(['method'=>'DELETE', 'action'=>['PersonController@removeFile', $file->id], 'onsubmit'=>'return confirm("Are you sure you want to delete?")']) !!}                
                            {!! Form::submit('Delete', ['class'=> 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!} 
                    </td>
                </tr>
                @endforeach
                @endunless                        

            </tbody>
        </table>      
        {!! $files->render() !!}
    </div>

    <div class="panel-footer">
        {!! Form::open(['action'=>['PersonController@addFile', $person->id], 'class'=>'dropzone', 'style'=>'margin-top:20px']) !!}
        {!! Form::close() !!}
        <label class="pull-right totalnum" for="totalnum">
            Total of {{$files->total()}} entries
        </label>
    </div>
</div>
</div>

<script>
$(document).ready(function() {
    Dropzone.autoDiscover = false;
    $('.dropzone').dropzone({
        init: function() 
        {
            this.on("complete", function()
            {
              if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                location.reload();
              }                
            });
        }
    });
});
</script>
<script src="/js/person_edit.js"></script>  

@stop