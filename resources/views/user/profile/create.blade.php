@extends('template')
@section('title')
Company Profile
@stop
@section('content')

<div class="create_edit">
<div class="panel panel-primary">

    <div class="panel-heading">
        <h3 class="panel-title"><strong>New Profile</strong></h3>
    </div>

    <div class="panel-body">
        {!! Form::model($profile = new \App\Profile, ['action'=>'ProfileController@store']) !!}

            @include('user.profile.form')

            <div class="col-md-12">
                <div class="form-group pull-right" style="padding: 30px 190px 0px 0px;">
                    {!! Form::submit('Add', ['class'=> 'btn btn-success']) !!}
                    <a href="/user" class="btn btn-default">Cancel</a>            
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
</div>

@stop