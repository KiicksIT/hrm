@extends('template')
@section('title')
{{ $DEPT_TITLE }}
@stop
@section('content')

<div ng-app="app" ng-controller="departmentController">
    <div class="create_edit">
    <div class="panel panel-primary">

        <div class="panel-heading">
            <h3 class="panel-title"><strong>Editing {{$department->name}} </strong></h3>
        </div>

        <div class="panel-body">
            {!! Form::model($department,['method'=>'PATCH','action'=>['DeptController@update', $department->id]]) !!}
                {!! Form::text('department_id', $department->id, ['id'=>'department_id', 'class'=>'hidden form-control']) !!}            

                @include('department.form_ch')

                <div class="col-md-12">
                    <div class="pull-right form_button_right">
                        {!! Form::submit('Edit', ['class'=> 'btn btn-primary']) !!}
            {!! Form::close() !!}

                        <a href="/department" class="btn btn-default">Cancel</a>            
                    </div>
                    <div class="pull-left form_button_left">
                        {!! Form::open(['method'=>'DELETE', 'action'=>['DeptController@destroy', $department->id], 'onsubmit'=>'return confirm("Are you sure you want to delete?")']) !!}                
                            {!! Form::submit('Delete', ['class'=> 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </div>                
                </div>
        </div>
    </div>
    </div>

    <hr>

    <label class="pull-right " >Total @{{people.length}} employee(s) for this department</label>     

    <div style="padding-bottom: 10px">
        <label for="search_name" class="search">Search Name:</label>
        {{-- <label for="search_name" class="search">Search Name 名字:</label> --}}
        <input type="text" ng-model="search.name">
        <label for="search_dept" class="search" style="padding-left: 10px;">Search Position:</label>
        {{-- <label for="search_dept" class="search" style="padding-left: 10px;">Search Position 职位:</label> --}}
        <input type="text" ng-model="search.position.name">        
    </div>

    <table class="table table-list-search table-hover table-bordered">
        <tr style="background-color: #DDFDF8">
            <th class="col-md-1 text-center">
                #
            </th>                    
            <th class="col-md-1 text-center">
                <a href="#" ng-click="sortType = 'id'; sortReverse = !sortReverse">
                ID
                <span ng-show="sortType == 'id' && !sortReverse" class="fa fa-caret-down"></span>
                <span ng-show="sortType == 'id' && sortReverse" class="fa fa-caret-up"></span>                            
            </th>
            <th class="col-md-3 text-center">
                <a href="#" ng-click="sortType = 'name'; sortReverse = !sortReverse">
                Name
                {{-- Name 名字 --}}
                <span ng-show="sortType == 'name' && !sortReverse" class="fa fa-caret-down"></span>
                <span ng-show="sortType == 'name' && sortReverse" class="fa fa-caret-up"></span>                
            </th>                     
            <th class="col-md-2 text-center">
                <a href="#" ng-click="sortType = 'position.name'; sortReverse = !sortReverse">
                Position
                {{-- Position 职位 --}}
                <span ng-show="sortType == 'position.name' && !sortReverse" class="fa fa-caret-down"></span>
                <span ng-show="sortType == 'position.name' && sortReverse" class="fa fa-caret-up"></span>                 
            </th>
            <th class="col-md-2 text-center">
                Contact
                {{-- Contact 联络号码 --}}
            </th>
            <th class="col-md-3 text-center">
                Email
                {{-- Email 电子邮件 --}}
            </th>                                                                                               
        </tr>

        <tbody>
            <tr dir-paginate="person in people | filter:search | orderBy:sortType:sortReverse | itemsPerPage:itemsPerPage">
                <td class="col-md-1 text-center">@{{ $index + 1 }} </td>
                <td class="col-md-1">@{{ person.id }}</td>
                <td class="col-md-3">@{{ person.name }}</td>
                <td class="col-md-2">@{{ person.position.name }}</td>
                <td class="col-md-3">@{{ person.contact }}</td>
                <td class="col-md-3">@{{ person.email }}</td>

            </tr>
            <tr ng-show="(people | filter:search).length == 0 || ! people.length">
                <td colspan="7" class="text-center">No Records Found!</td>
            </tr>                         

        </tbody>
    </table>    
</div>

<script src="/js/department_edit.js"></script>
@stop