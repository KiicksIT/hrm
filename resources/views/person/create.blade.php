@extends('template')
@section('title')
{{ $PERSON_TITLE }}
@stop
@section('content')

<div class="create_edit">
<div class="panel panel-primary">

    <div class="panel-heading">
        <h3 class="panel-title"><strong>New {{$PERSON_TITLE}}</strong></h3>
    </div>

    <div class="panel-body">
        {!! Form::model($person = new \App\Person, ['action'=>'PersonController@store']) !!}

            @include('person.form')

            <div class="col-md-12">
                <div class="form-group pull-right">
                    {!! Form::submit('Add', ['class'=> 'btn btn-success']) !!}
                    <a href="/person" class="btn btn-default">Cancel</a>            
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
</div>
@stop
@section('footer')
    <script>
        $('#end_date').val('');
        $('#dob').val('');
    </script>
@stop