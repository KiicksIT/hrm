@extends('template')
@section('title')
{{ $MAININDEX_TITLE }}
@stop
@section('content')
    
    <div class="row">        
    <a class="title_hyper pull-left" href="/mainindex"><h1>{{ $MAININDEX_TITLE }} <i class="fa fa-dashboard"></i></h1></a>
    </div>

    {{-- create main index --}}
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><strong>New Feed</strong></h3>                  
            </div>
            <div class="panel-body">
                {!! Form::model($mainindex = new \App\MainIndex, ['action'=>'MainIndexController@store']) !!}

                    @include('mainindex.form')

                    <div class="col-md-10 col-md-offset-1">
                        <div class="form-group pull-right" style="padding: 20px 0px 0px 0px;">
                            {!! Form::submit('Add', ['class'=> 'btn btn-success']) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>            
        </div>
    {{-- end of create main index --}}

    {{-- display lists of feed --}}
    <?php $index = $mainindexes->firstItem(); ?>
    @foreach($mainindexes as $mainindex)
        <div class="jumbotron">
            <div class="row">
             {{--    <div class="col-md-1">
                    <h2>{{$index++}}.</h2>
                </div> --}}
                <div class="col-md-12">
                    <h2>
                    {{$mainindex->title}}
                        @if($mainindex->created_at->isToday())
                        <i class="fa fa-calendar-check-o" style="color:green;"></i>
                        @endif
                    </h2>
                </div>
            </div>
            <p>{{$mainindex->content}}</p>

            <div class="row" style="padding-top: 20px"> 
                <div class="pull-left">
                    {!! Form::open(['method'=>'DELETE', 'action'=>['MainIndexController@destroy', $mainindex->id], 'onsubmit'=>'return confirm("Are you sure you want to delete?")']) !!}                
                        {!! Form::submit('Delete', ['class'=> 'btn btn-danger']) !!}
                    {!! Form::close() !!}                    
                </div>
                <div class="pull-right">
                    <u><strong>{{$mainindex->created_at->format('d-F-Y')}}</strong></u>
                </div>
            </div>
        </div>
    @endforeach
    <div class="row">
        <div class="col-md-10">
            {!! $mainindexes->render() !!}    
        </div>
        <div class="col-md-2" style="padding-top: 20px">
            <strong> Total of {!! $mainindexes->total() !!} entries </strong>
        </div>
    </div>
    {{-- display end --}}
@stop