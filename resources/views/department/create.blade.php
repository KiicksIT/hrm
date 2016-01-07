@extends('template')
@section('title')
{{ $DEPT_TITLE }}
@stop
@section('content')

<div class="create_edit">
<div class="panel panel-primary">

    <div class="panel-heading">
        <h3 class="panel-title"><strong>New {{ $DEPT_TITLE }}</strong></h3>
    </div>

    <div class="panel-body">
        {!! Form::model($department = new \App\Department, ['action'=>'DeptController@store']) !!}

            @include('department.form')

            <div class="col-md-12">
                <div class="form-group pull-right">
                    {!! Form::submit('Add', ['class'=> 'btn btn-success']) !!}
                    <a href="/department" class="btn btn-default">Cancel</a>            
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
</div>

@stop