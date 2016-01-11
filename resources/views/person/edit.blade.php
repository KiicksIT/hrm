@extends('template')
@section('title')
{{ $PERSON_TITLE }}
@stop
@section('content')

<div class="create_edit">
<div class="panel panel-primary">

    <div class="panel-heading">
        <h3 class="panel-title"><strong>Profile for {{$person->id}} : {{$person->name}} </strong></h3>
    </div>

    <div class="panel-body">
        {!! Form::open(['id'=>'form_print', 'method'=>'POST', 'action'=>['PersonController@generateKET', $person->id]]) !!}
        {!! Form::close() !!}     
        {!! Form::model($person,['method'=>'PATCH','action'=>['PersonController@update', $person->id]]) !!}            

            @include('person.form')

            <div class="col-md-12 " style="padding-top: 10px;">
                <div class="pull-right">
                    {!! Form::submit('Edit Profile', ['class'=> 'btn btn-warning']) !!}
        {!! Form::close() !!}
                    {!! Form::submit('Print KET', ['name'=>'print', 'class'=> 'btn btn-primary', 'form'=>'form_print']) !!}
                    <a href="/person" class="btn btn-default">Cancel</a>            
                </div>
                <div class="pull-left row">
                        <div class="col-md-3">
                        {!! Form::open(['method'=>'DELETE', 'action'=>['PersonController@destroy', $person->id], 'onsubmit'=>'return confirm("Are you sure you want to delete?")']) !!}                
                            {!! Form::submit('Delete', ['class'=> 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </div>
                    <div class="col-md-3 col-md-offset-1">
                        <a href="/person/user/{{$person->id}}" class="btn btn-success">Convert to User</a>
                    </div>
                </div>                
            </div>
    </div>
</div>
{{-- second content --}}


{{-- third content --}}
<div class="panel panel-primary">
    <div class="panel-heading">
        <div class="panel-title">
            <h3 class="panel-title"><strong>File : {{$person->name}}</strong></h3>
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