@extends('template')
@section('title')
{{ $PERSON_TITLE }}
@stop
@section('content')
    
    <div class="row">        
    <a class="title_hyper pull-left" href="/person"><h1>{{ $PERSON_TITLE }} <i class="fa fa-users"></i></h1></a>
    </div>
    <div ng-app="app" ng-controller="personController">

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">

                    <div class="pull-left display_panel_title">
                        <label for="display_num">Display</label>
                        <select ng-model="itemsPerPage" ng-init="itemsPerPage='10'">
                          <option>10</option>
                          <option>20</option>
                          <option>30</option>
                        </select>
                        <label for="display_num2" style="padding-right: 20px">per Page</label>
                    </div>

                    <div class="pull-right">
                        {{-- <input type="button" class="btn btn-primary" name="submit" value="Send Mail" ng-click="check(people)"/> --}}
                        <a href="#" ng-click="check(people)" class="btn btn-primary"><i class="fa fa-envelope"></i></a>
                        <a href="/person/create" class="btn btn-success">+ New {{ $PERSON_TITLE }}</a>                        
                    </div>
                </div>
            </div>

            <div class="panel-body">
                <div style="padding-bottom: 10px">
                    {{-- <label for="search_company" class="search">Search Name:</label> --}}
                    <label for="search_company" class="search">Search Name 名字:</label>
                    <input type="text" ng-model="search.name">
                    {{-- <label for="search_contact" class="search" style="padding-left: 10px">Dept:</label> --}}
                   {{--  <label for="search_contact" class="search" style="padding-left: 10px">Dept 部门:</label>
                    <input type="text" ng-model="search.department.name">  --}}                   
                    {{-- <label for="search_name" class="search" style="padding-left: 10px">Position:</label> --}}
                    <label for="search_name" class="search" style="padding-left: 10px">Position 职位:</label>
                    <input type="text" ng-model="search.position.name">                    

                </div>
                <div class="table-responsive">
                    <table class="table table-list-search table-hover table-bordered">
                        <tr style="background-color: #DDFDF8">
                            <th class="col-md-1 text-center">
                                {{-- <input type="checkbox" class="checkall" /> --}}
                            </th>
                            <th class="col-md-1 text-center">
                                #
                            </th>                    
                            <th class="col-md-1 text-center">
                                ID                           
                            </th>
                            <th class="col-md-2 text-center">
                                {{-- Name --}}
                                Name 名字
                            </th>                            
                            <th class="col-md-2 text-center">
                                {{-- Position --}}
                                Position 职位
                            </th>
                        {{--     <th class="col-md-1 text-center">
                                Department
                                Department 部门
                            </th> --}}                             
                            <th class="col-md-1 text-center">
                                {{-- Contact --}}
                                Contact 联络号码
                            </th>  
                            <th class="col-md-2 text-center">
                                {{-- Email --}}
                                Email 电子邮件
                            </th>                                                                            
                            <th class="col-md-2 text-center">
                                Action
                            </th>                                                                                                
                        </tr>

                        <tbody>
                            <tr dir-paginate="person in people | filter:search | orderBy:sortType:sortReverse | itemsPerPage:itemsPerPage"  current-page="currentPage" ng-controller="repeatController">
                                <td class="col-md-1 text-center">
                                    {!! Form::checkbox('name', '@{{person.id}}', false,  ['ng-model'=>"person.SELECTED", 'ng-true-value'=>"'Y'", 'ng-false-value'=>"'N'"]) !!}
                                </td>
                                <td class="col-md-1 text-center">@{{ number }} </td>
                                <td class="col-md-1">@{{ person.id }}</td>
                                <td class="col-md-2">@{{ person.name }}</td>
                                <td class="col-md-2 text-center">@{{ person.position.name }}</td>
                                {{-- <td class="col-md-1 text-center">@{{ person.department.name }}</td> --}}
                                <td class="col-md-1">@{{ person.contact }}</td>
                                <td class="col-md-2">@{{ person.email }}</td>
                                <td class="col-md-2 text-center">
                                    <a href="/person/@{{ person.id }}/edit" class="btn btn-sm btn-primary">Profile</a>
                                    <button class="btn btn-danger btn-sm btn-delete" ng-click="confirmDelete(person.id)">Delete</button>
                                </td>
                            </tr>
                            <tr ng-show="(people | filter:search).length == 0 || ! people.length">
                                <td colspan="9" class="text-center">No Records Found</td>
                            </tr>                         

                        </tbody>
                    </table>
                </div>            
            </div>
                <div class="panel-footer">
                      <dir-pagination-controls max-size="5" direction-links="true" boundary-links="true" class="pull-left"> </dir-pagination-controls>
                      <label class="pull-right totalnum" for="totalnum">Showing @{{(people | filter:search).length}} of @{{people.length}} entries</label> 
                </div>
        </div>
    </div>  

    <script src="/js/person.js"></script>  
@stop