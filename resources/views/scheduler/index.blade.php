@extends('template')
@section('title')
{{ $SCHEDULER_TITLE }}
@stop
@section('content')
    
    <div class="row">        
    <a class="title_hyper pull-left" href="/scheduler"><h1>{{ $SCHEDULER_TITLE }} <i class="fa fa-clock-o"></i></h1></a>
    </div>
    <div ng-app="app" ng-controller="schedulerController">
        {{-- create form on index page --}}
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><strong>New Todo</strong></h3>                  
            </div>
            <div class="panel-body">
                {!! Form::model($scheduler = new \App\Scheduler, ['action'=>'SchedulerController@store']) !!}

                    @include('scheduler.form_index')

                    <div class="col-md-12">
                        <div class="form-group pull-right" style="padding: 0px 15px 0px 0px;">
                            {!! Form::submit('Add', ['class'=> 'btn btn-success']) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>            
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                    <ul class="nav nav-pills nav-justified" role="tablist">
                        <li class="active"><a href="#pending" role="tab" data-toggle="tab">Pending</a></li>
                        <li><a href="#complete" role="tab" data-toggle="tab">Complete</a></li>
                    </ul>
            </div>

            <div class="panel-body">
                <div class="tab-content">
                {{-- first content --}}
                {{-- status pending table --}}
                <div class="tab-pane active" id="pending">                        
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
                            </div>
                        </div>

                        <div class="panel-body">
                            <div style="padding-bottom: 10px">
                                <label for="search_name" class="search">Search Name:</label>
                                <input type="text" ng-model="search.name">
                                <label for="search_company" class="search" style="padding-left: 10px">Appt Date:</label>
                                <input type="text" ng-model="search.appt_date">
                            </div>
                            <div class="table-responsive">
                                <table class="table table-list-search table-hover table-bordered">
                                    <tr style="background-color: #DDFDF8">
                                        <th class="col-md-1 text-center">
                                            #
                                        </th>                    
                                        <th class="col-md-3 text-center">
                                            Name                          
                                        </th>
                                        <th class="col-md-2 text-center">
                                            Remark
                                        </th>                            
                                        <th class="col-md-2 text-center">
                                            <a href="#" ng-click="sortType = 'appt_date'; sortReverse = !sortReverse">
                                            Appt Date
                                            <span ng-show="sortType == 'appt_date' && !sortReverse" class="fa fa-caret-down"></span>
                                            <span ng-show="sortType == 'appt_date' && sortReverse" class="fa fa-caret-up"></span>
                                            </a>                            
                                        </th>
                                        <th class="col-md-2 text-center">
                                            <a href="#" ng-click="sortType = 'notify_date'; sortReverse = !sortReverse">
                                            Notify On
                                            <span ng-show="sortType == 'notify_date' && !sortReverse" class="fa fa-caret-down"></span>
                                            <span ng-show="sortType == 'notify_date' && sortReverse" class="fa fa-caret-up"></span>
                                        </th>
                                         <th class="col-md-2 text-center">
                                            Action
                                        </th>                                                                                                
                                    </tr>

                                    <tbody>
                                        <tr dir-paginate="scheduler in schedulers | filter:search | orderBy:sortType:sortReverse | itemsPerPage:itemsPerPage"  current-page="currentPage" ng-controller="repeatController">
                                            <td class="col-md-1 text-center">@{{ number }} </td>
                                            <td class="col-md-3">@{{ scheduler.name }}</td>
                                            <td class="col-md-2">@{{ scheduler.remark }}</td>
                                            <td class="col-md-2">@{{ scheduler.appt_date }}</td>
                                            <td class="col-md-2">@{{ scheduler.notify_date }}</td>
                                            <td class="col-md-2 text-center">
                                            {{--     {!! Form::model($scheduler,['id'=>'done', 'method'=>'PATCH','action'=>['SchedulerController@update', '@{{scheduler.id}}']]) !!}
                                                {!! Form::close() !!}
                                                {!! Form::submit('Done', ['class'=> 'btn btn-sm btn-success', 'form'=>'done']) !!} --}}
                                                <a href="/scheduler/@{{ scheduler.id }}" class="btn btn-success btn-sm">Done</a>                               
                                                <a href="/scheduler/@{{ scheduler.id }}/edit" class="btn btn-sm btn-primary">Edit</a>
                                            </td>
                                        </tr>
                                        <tr ng-show="(schedulers | filter:search).length == 0 || ! schedulers.length">
                                            <td colspan="7" class="text-center">No Records Found</td>
                                        </tr>                         

                                    </tbody>
                                </table>
                            </div>            
                        </div>
                            <div class="panel-footer">
                                  <dir-pagination-controls max-size="5" direction-links="true" boundary-links="true" class="pull-left"> </dir-pagination-controls>
                                  <label ng-if="schedulers" class="pull-right totalnum" for="totalnum">Showing @{{(schedulers | filter:search).length}} of @{{schedulers.length}} entries</label> 
                            </div>
                    </div>
                </div>
                {{-- divider for 2nd content --}}
                {{-- status complete table --}}
                <div class="tab-pane" id="complete">                        
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
                            </div>
                        </div>

                        <div class="panel-body">
                            <div style="padding-bottom: 10px">
                                <label for="search_name" class="search">Search Name:</label>
                                <input type="text" ng-model="search.name">
                                <label for="search_company" class="search" style="padding-left: 10px">Appt Date:</label>
                                <input type="text" ng-model="search.appt_date">
                            </div>
                            <div class="table-responsive">
                                <table class="table table-list-search table-hover table-bordered">
                                    <tr style="background-color: #DDFDF8">
                                        <th class="col-md-1 text-center">
                                            #
                                        </th>                    
                                        <th class="col-md-4 text-center">
                                            Name                          
                                        </th>
                                        <th class="col-md-3 text-center">
                                            Remark
                                        </th>                            
                                        <th class="col-md-2 text-center">
                                            <a href="#" ng-click="sortType = 'appt_date'; sortReverse = !sortReverse">
                                            Appt Date
                                            <span ng-show="sortType == 'appt_date' && !sortReverse" class="fa fa-caret-down"></span>
                                            <span ng-show="sortType == 'appt_date' && sortReverse" class="fa fa-caret-up"></span>
                                            </a>                            
                                        </th>
                                         <th class="col-md-2 text-center">
                                            Action
                                        </th>                                                                                                
                                    </tr>

                                    <tbody>
                                        <tr dir-paginate="scheduler in cschedulers | filter:search | orderBy:sortType:sortReverse | itemsPerPage:itemsPerPage"  current-page="currentPage" ng-controller="repeatController">
                                            <td class="col-md-1 text-center">@{{ number }} </td>
                                            <td class="col-md-4">@{{ scheduler.name }}</td>
                                            <td class="col-md-3">@{{ scheduler.remark }}</td>
                                            <td class="col-md-2">@{{ scheduler.appt_date }}</td>
                                            <td class="col-md-2 text-center">
                                                <a href="/scheduler/@{{ scheduler.id }}/edit" class="btn btn-sm btn-default">View</a>
                                                <button class="btn btn-danger btn-sm btn-delete" ng-click="confirmDelete(scheduler.id)">Delete</button>
                                            </td>
                                        </tr>
                                        <tr ng-show="(cschedulers | filter:search).length == 0 || ! cschedulers.length">
                                            <td colspan="7" class="text-center">No Records Found</td>
                                        </tr>                         

                                    </tbody>
                                </table>
                            </div>            
                        </div>
                            <div class="panel-footer">
                                  <dir-pagination-controls max-size="5" direction-links="true" boundary-links="true" class="pull-left"> </dir-pagination-controls>
                                  <label ng-if="cschedulers" class="pull-right totalnum" for="totalnum">Showing @{{(cschedulers | filter:search).length}} of @{{cschedulers.length}} entries</label> 
                            </div>
                    </div>
                </div>
                {{-- end of content --}}
                </div>
            </div>

        </div>
            
    </div>  

    <script src="/js/scheduler.js"></script>  
@stop