@extends('template')
@section('title')
{{ $LEAVE_TITLE }}
@stop
@section('content')
    
    <div class="row">        
    <a class="title_hyper pull-left" href="/leave"><h1> {{ $LEAVE_TITLE }} <i class="fa fa-calendar-times-o"></i></h1></a>
    </div>
    <div ng-app="app" ng-controller="leaveController">

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
                    <input type="text" ng-model="search.person.name">
                    <label for="search_company" class="search" style="padding-left: 10px">Dept:</label>
                    <input type="text" ng-model="search.person.department.name">
                    <label for="search_contact" class="search" style="padding-left: 10px">Position:</label>
                    <input type="text" ng-model="search.person.positon.name">
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
                            <th class="col-md-2 text-center">
                                Department                      
                            </th>
                            <th class="col-md-2 text-center">
                                Position
                            </th>                                                
                            <th class="col-md-1 text-center">
                                Paid Leave
                            </th>
                            <th class="col-md-1 text-center">
                                Sick Leave
                            </th>
                            <th class="col-md-1 text-center">
                                Hospt Leave
                            </th>                                                        
                             <th class="col-md-2 text-center">
                                Action
                            </th>                                                                                                
                        </tr>

                        <tbody>
                            <tr dir-paginate="leave in leaves | filter:search | orderBy:sortType:sortReverse | itemsPerPage:itemsPerPage"  current-page="currentPage" ng-controller="repeatController">
                                <td class="col-md-1 text-center">@{{ number }} </td>
                                <td class="col-md-2 text-center">@{{ leave.person.name }}</td>
                                <td class="col-md-2">@{{ leave.person.department.name }}</td>
                                <td class="col-md-2">@{{ leave.person.position.name }}</td>
                                <td class="col-md-1 text-center">@{{ leave.total_paidleave }}</td>
                                <td class="col-md-1 text-center">@{{ leave.total_paidsickleave }}</td>
                                <td class="col-md-1 text-center">@{{ leave.total_paidhospleave }}</td>
                                <td class="col-md-2 text-center">
                                    <a href="/leave/@{{ leave.id }}/edit" class="btn btn-sm btn-primary">Edit</a>
                                    <button class="btn btn-danger btn-sm btn-delete" ng-click="confirmDelete(leave.id)">Delete</button>
                                </td>
                            </tr>
                            <tr ng-show="(leaves | filter:search).length == 0 || ! leaves.length">
                                <td colspan="8" class="text-center">No Records Found!</td>
                            </tr>                         

                        </tbody>
                    </table>            
                </div>
            </div>
                <div class="panel-footer">
                      <dir-pagination-controls max-size="5" direction-links="true" boundary-links="true" class="pull-left"> </dir-pagination-controls>
                      <label class="pull-right totalnum" for="totalnum">Showing @{{(leaves | filter:search).length}} of @{{leaves.length}} entries</label> 
                </div>
        </div>
    </div>  
    <script src="/js/leave.js"></script>  
@stop