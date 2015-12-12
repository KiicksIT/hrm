@extends('template')
@section('title')
{{ $MARKET_TITLE }}
@stop
@section('content')
    
    <div class="row">        
    <a class="title_hyper pull-left" href="/market"><h1>{{ $MARKET_TITLE }} <i class="fa fa-tasks"></i></h1></a>
            <div class="row" style="margin: 30px 10px 0px 0px">

                <ul class="list-inline list-unstyle pull-right">
                    <li>
                    <a href="/market/create/Lead" class="btn btn-success">Add Lead</a>   
                    </li>
                    <li>
                    <a href="/market/create/Prospect" class="btn btn-primary">Add Prospect</a>
                    </li>
                    <li>
                    <a href="/market/create/Closed" class="btn btn-warning">Add Closed</a>
                    </li>
                </ul>
            </div>    
    </div>

    <div ng-app="app" ng-controller="marketController">
        <div class="panel panel-warning">
            <div class="panel-heading">
                    <ul class="nav nav-pills nav-justified" role="tablist">
                        <li class="active"><a href="#lead" role="tab" data-toggle="tab">Lead</a></li>
                        <li><a href="#prospect" role="tab" data-toggle="tab">Prospect</a></li>
                        <li><a href="#closed" role="tab" data-toggle="tab">Closed</a></li>
                    </ul>
            </div>

            <div class="panel-body">
                <div class="tab-content">
                {{-- first content --}}
                {{-- status lead table --}}
                <div class="tab-pane active" id="lead">                        
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">

                                <div class="pull-left display_panel_title">
                                    <label for="display_num">Display</label>
                                    <select ng-model="itemsPerPage1" ng-init="itemsPerPage1='10'">
                                      <option>10</option>
                                      <option>20</option>
                                      <option>30</option>
                                    </select>
                                    <label for="display_num2" style="padding-right: 20px">per Page</label>
                                </div>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div style="padding-bottom: 10px">
                                <label for="search_name" class="search">Search Name:</label>
                                <input type="text" ng-model="search.name">
                                <label for="search_company" class="search" style="padding-left: 10px">Subject:</label>
                                <input type="text" ng-model="search.subject">
                                <a href="#" ng-click="check1(markets1)" class="btn btn-primary pull-right"><i class="fa fa-envelope"></i></a>   
                            </div>
                            <div class="table-responsive">
                                <table class="table table-list-search table-hover table-bordered">
                                    <tr style="background-color: #DDFDF8">
                                        <th></th>
                                        <th class="col-md-1 text-center">
                                            #
                                        </th>                    
                                        <th class="col-md-2 text-center">
                                            Name
                                        </th>
                                        <th class="col-md-1 text-center">
                                            Contact
                                        </th> 
                                        <th class="col-md-1 text-center">
                                            Email
                                        </th>
                                        <th class="col-md-2 text-center">
                                            Subject
                                        </th>
                                        <th class="col-md-2 text-center">
                                            <a href="#" ng-click="sortType = 'created_at'; sortReverse = !sortReverse">
                                            Created On
                                            <span ng-show="sortType == 'created_at' && !sortReverse" class="fa fa-caret-down"></span>
                                            <span ng-show="sortType == 'created_at' && sortReverse" class="fa fa-caret-up"></span>
                                        </th>                                         
                                         <th class="col-md-2 text-center">
                                            Action
                                        </th>                                                                                                
                                    </tr>

                                    <tbody>
                                        <tr dir-paginate="market in markets1 | filter:search | orderBy:sortType:sortReverse | itemsPerPage:itemsPerPage1"  current-page="currentPage1" ng-controller="repeatController1" pagination-id="1">
                                            <td class="col-md-1 text-center">
                                            {!! Form::checkbox('name', '@{{market.id}}', false,  ['ng-model'=>"market.SELECTED1", 'ng-true-value'=>"'Y'", 'ng-false-value'=>"'N'"]) !!}                                                
                                            </td>
                                            <td class="col-md-1 text-center">@{{ number }} </td>
                                            <td class="col-md-2">@{{ market.name }}</td>
                                            <td class="col-md-1">@{{ market.contact }}</td>
                                            <td class="col-md-1">@{{ market.email }}</td>
                                            <td class="col-md-2">@{{ market.subject }}</td>
                                            <td class="col-md-2 text-center">@{{ market.created_at }}</td>
                                            <td class="col-md-2 text-center">
                                                <a href="/market/@{{ market.id }}" class="btn btn-success btn-sm">Convert</a>
                                                <a href="/market/@{{ market.id }}/edit" class="btn btn-sm btn-primary">Edit</a>
                                            </td>
                                        </tr>
                                        <tr ng-show="(markets1 | filter:search).length == 0 || ! markets1.length">
                                            <td colspan="8" class="text-center">No Records Found</td>
                                        </tr>                         

                                    </tbody>
                                </table>
                            </div>            
                        </div>
                            <div class="panel-footer">
                                  <dir-pagination-controls max-size="5" direction-links="true" boundary-links="true" class="pull-left" pagination-id="1"> </dir-pagination-controls>
                                  <label ng-if="markets1" class="pull-right totalnum" for="totalnum">Showing @{{(markets1 | filter:search).length}} of @{{markets1.length}} entries</label> 
                            </div>
                    </div>
                </div>
                {{-- divider for 2nd content --}}
                {{-- status prospect table --}}
                <div class="tab-pane" id="prospect">                        
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">

                                <div class="pull-left display_panel_title">
                                    <label for="display_num">Display</label>
                                    <select ng-model="itemsPerPage2" ng-init="itemsPerPage2='10'">
                                      <option>10</option>
                                      <option>20</option>
                                      <option>30</option>
                                    </select>
                                    <label for="display_num2" style="padding-right: 20px">per Page</label>
                                </div>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div style="padding-bottom: 10px">
                                <label for="search_company" class="search" style="padding-left: 10px">Name:</label>
                                <input type="text" ng-model="search.name">
                                <label for="search_subject" class="search" style="padding-left: 10px">Subject:</label>
                                <input type="text" ng-model="search.subject"> 
                                <label for="search_apptdate" class="search" style="padding-left: 10px">Appt Date:</label>
                                <input type="text" ng-model="search.appt_date">
                                <a href="#" ng-click="check2(markets2)" class="btn btn-primary pull-right"><i class="fa fa-envelope"></i></a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-list-search table-hover table-bordered">
                                    <tr style="background-color: #DDFDF8">
                                        <th></th>
                                        <th class="col-md-1 text-center">
                                            #
                                        </th>                    
                                        <th class="col-md-2 text-center">
                                            Name
                                        </th>
                                        <th class="col-md-1 text-center">
                                            Contact
                                        </th>
                                        <th class="col-md-2 text-center">
                                            Subject
                                        </th>                                        
                                        <th class="col-md-2 text-center">
                                            <a href="#" ng-click="sortType = 'appt_date'; sortReverse = !sortReverse">
                                            Appt Date
                                            <span ng-show="sortType == 'appt_date' && !sortReverse" class="fa fa-caret-down"></span>
                                            <span ng-show="sortType == 'appt_date' && sortReverse" class="fa fa-caret-up"></span>
                                        </th>       
                                        <th class="col-md-1 text-center">
                                            <a href="#" ng-click="sortType = 'created_at'; sortReverse = !sortReverse">
                                            Created On
                                            <span ng-show="sortType == 'created_at' && !sortReverse" class="fa fa-caret-down"></span>
                                            <span ng-show="sortType == 'created_at' && sortReverse" class="fa fa-caret-up"></span>
                                        </th>          
                                         <th class="col-md-2 text-center">
                                            Action
                                        </th>                                                                                                
                                    </tr>

                                    <tbody>
                                        <tr dir-paginate="market in markets2 | filter:search | orderBy:sortType:sortReverse | itemsPerPage:itemsPerPage2"  current-page="currentPage2" ng-controller="repeatController2" pagination-id="2">
                                            <td class="col-md-1 text-center">
                                            {!! Form::checkbox('name', '@{{market.id}}', false,  ['ng-model'=>"market.SELECTED2", 'ng-true-value'=>"'Y'", 'ng-false-value'=>"'N'"]) !!}                                                 
                                            </td>
                                            <td class="col-md-1 text-center">@{{ number }} </td>
                                            <td class="col-md-2">@{{ market.name }}</td>
                                            <td class="col-md-1">@{{ market.contact }}</td>
                                            <td class="col-md-2">@{{ market.subject }}</td>
                                            <td class="col-md-2">@{{ market.appt_date }}</td>
                                            <td class="col-md-1 text-center">@{{ market.created_at }}</td>
                                            <td class="col-md-2 text-center">
                                                <a href="/market/@{{ market.id }}" class="btn btn-warning btn-sm">Revert</a>
                                                <a href="/market/@{{ market.id }}/edit" class="btn btn-sm btn-primary">Edit</a>
                                            </td>
                                        </tr>
                                        <tr ng-show="(markets2 | filter:search).length == 0 || ! markets2.length">
                                            <td colspan="8" class="text-center">No Records Found</td>
                                        </tr>                         

                                    </tbody>
                                </table>
                            </div>            
                        </div>
                            <div class="panel-footer">
                                  <dir-pagination-controls max-size="5" direction-links="true" boundary-links="true" class="pull-left" pagination-id="2"> </dir-pagination-controls>
                                  <label ng-if="markets2" class="pull-right totalnum" for="totalnum">Showing @{{(markets2 | filter:search).length}} of @{{markets2.length}} entries</label> 
                            </div>
                    </div>
                </div>
                {{-- divider for 3rd content --}}
                {{-- status closed table --}}
                <div class="tab-pane" id="closed">                        
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">

                                <div class="pull-left display_panel_title">
                                    <label for="display_num">Display</label>
                                    <select ng-model="itemsPerPage3" ng-init="itemsPerPage3='10'">
                                      <option>10</option>
                                      <option>20</option>
                                      <option>30</option>
                                    </select>
                                    <label for="display_num2" style="padding-right: 20px">per Page</label>
                                </div>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div style="padding-bottom: 10px">
                                <label for="search_name" class="search">Search Name:</label>
                                <input type="text" ng-model="search.company">
                                <label for="search_company" class="search" style="padding-left: 10px">Subject:</label>
                                <input type="text" ng-model="search.subject">                                
                            </div>
                            <div class="table-responsive">
                                <table class="table table-list-search table-hover table-bordered">
                                    <tr style="background-color: #DDFDF8">
                                        <th class="col-md-1 text-center">
                                            #
                                        </th>                    
                                        <th class="col-md-2 text-center">
                                            Name
                                        </th>
                                        <th class="col-md-1 text-center">
                                            Contact
                                        </th>                                                                    
                                        <th class="col-md-2 text-center">
                                            Email                           
                                        </th>
                                        <th class="col-md-2 text-center">
                                            Subject
                                        </th>
                                        <th class="col-md-2 text-center">
                                            <a href="#" ng-click="sortType = 'created_at'; sortReverse = !sortReverse">
                                            Created On
                                            <span ng-show="sortType == 'created_at' && !sortReverse" class="fa fa-caret-down"></span>
                                            <span ng-show="sortType == 'created_at' && sortReverse" class="fa fa-caret-up"></span>
                                        </th>                                              
                                         <th class="col-md-2 text-center">
                                            Action
                                        </th>                                                                                                
                                    </tr>

                                    <tbody>
                                        <tr dir-paginate="market in markets3 | filter:search | orderBy:sortType:sortReverse | itemsPerPage:itemsPerPage3"  current-page="currentPage3" ng-controller="repeatController3" pagination-id="3">
                                            <td class="col-md-1 text-center">@{{ number }} </td>
                                            <td class="col-md-2">@{{ market.name }}</td>
                                            <td class="col-md-1">@{{ market.contact }}</td>
                                            <td class="col-md-2">@{{ market.email }}</td>
                                            <td class="col-md-2">@{{ market.subject }}</td>
                                            <td class="col-md-2 text-center">@{{ market.created_at }}</td>
                                            <td class="col-md-2 text-center">
                                                <a href="/market/@{{ market.id }}" class="btn btn-default btn-sm">View</a>
                                            </td>
                                        </tr>
                                        <tr ng-show="(markets3 | filter:search).length == 0 || ! markets3.length">
                                            <td colspan="7" class="text-center">No Records Found</td>
                                        </tr>                         

                                    </tbody>
                                </table>
                            </div>            
                        </div>
                            <div class="panel-footer">
                                  <dir-pagination-controls max-size="5" direction-links="true" boundary-links="true" class="pull-left" pagination-id="3"> </dir-pagination-controls>
                                  <label ng-if="markets3" class="pull-right totalnum" for="totalnum">Showing @{{(markets3 | filter:search).length}} of @{{markets3.length}} entries</label> 
                            </div>
                    </div>
                </div>
                {{-- end of content --}}
                </div>
            </div>

        </div>
            
    </div>  

    <script src="/js/market.js"></script>  
@stop