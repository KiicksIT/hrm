@extends('template')
@section('title')
{{ $LEAVE_TITLE }}
@stop
@section('content')
    
    <div class="row">        
    <a class="title_hyper pull-left" href="/leave"><h1> {{ $LEAVE_TITLE }} <i class="fa fa-calendar-times-o"></i></h1></a>
    </div>
    <div ng-app="app" ng-controller="leaveController">
    
    <div class="panel panel-warning">
        <div class="panel-heading">
            <ul class="nav nav-pills nav-justified" role="tablist">
                <li class="active"><a href="#application" role="tab" data-toggle="tab">Leave Application 假期申请</a></li>
                <li><a href="#setting" role="tab" data-toggle="tab">Leave Setting 假期设置</a></li>
            </ul>
        </div>

        <div class="panel-body">
            <div class="tab-content">

                {{-- Leave Application --}}
                <div class="tab-pane active" id="application">
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
                                <label for="search_name" class="search">Search Name 名字:</label>
                                <input type="text" ng-model="search.person.name">
                                <label for="search_contact" class="search" style="padding-left: 10px">Position 职位:</label>
                                <input type="text" ng-model="search.person.positon.name">
                            </div>
                            <div style="padding-bottom: 10px">
                                <label for="search_name" class="search">Status 状态:</label>
                                <input type="text" ng-model="search.status">
                                <label for="search_company" class="search" style="padding-left: 10px">Apply On 申请日期:</label>
                                <input type="text" ng-model="search.created_at">
                            </div>                            
                            <div class="table-responsive">
                                <table class="table table-list-search table-hover table-bordered">
                                    <tr style="background-color: #DDFDF8">
                                        <th class="col-md-1 text-center">
                                            #
                                        </th>                    
                                        <th class="col-md-2 text-center">
                                        <a href="" ng-click="sortType = 'name'; sortReverse = !sortReverse">
                                            Name 
                                            <br>
                                            名字
                                        <span ng-show="sortType == 'name' && !sortReverse" class="fa fa-caret-down"></span>
                                        <span ng-show="sortType == 'name' && sortReverse" class="fa fa-caret-up"></span>
                                        </th>
                                        <th class="col-md-2 text-center">
                                        <a href="" ng-click="sortType = 'person.position.name'; sortReverse = !sortReverse">
                                            Position 
                                            <br>
                                            职位
                                        <span ng-show="sortType == 'person.position.name' && !sortReverse" class="fa fa-caret-down"></span>
                                        <span ng-show="sortType == 'person.position.name' && sortReverse" class="fa fa-caret-up"></span>
                                        </th>                                                
                                        <th class="col-md-2 text-center">
                                        <a href="" ng-click="sortType = 'person.leave_type'; sortReverse = !sortReverse">
                                            Leave Type 
                                            <br>
                                            假期种类
                                        <span ng-show="sortType == 'person.leave_type' && !sortReverse" class="fa fa-caret-down"></span>
                                        <span ng-show="sortType == 'person.leave_type' && sortReverse" class="fa fa-caret-up"></span>
                                        </th>
                                        <th class="col-md-2 text-center">
                                        <a href="" ng-click="sortType = 'created_at'; sortReverse = !sortReverse">
                                            Apply On 
                                            <br>
                                            申请日期
                                        <span ng-show="sortType == 'created_at' && !sortReverse" class="fa fa-caret-down"></span>
                                        <span ng-show="sortType == 'created_at' && sortReverse" class="fa fa-caret-up"></span>
                                        </th>
                                        <th class="col-md-1 text-center">
                                        <a href="" ng-click="sortType = 'status'; sortReverse = !sortReverse">
                                            Status 
                                            <br>
                                            状态
                                        <span ng-show="sortType == 'status' && !sortReverse" class="fa fa-caret-down"></span>
                                        <span ng-show="sortType == 'status' && sortReverse" class="fa fa-caret-up"></span>
                                        </th>                                                        
                                        <th class="col-md-1 text-center">
                                            Action
                                        </th>                                                                                                
                                    </tr>

                                    <tbody>
                                        <tr dir-paginate="applyleave in applyleaves | filter:search | orderBy:sortType:sortReverse | itemsPerPage:itemsPerPage1"  current-page="currentPage1" ng-controller="repeatController1" pagination-id="1">
                                            <td class="col-md-1 text-center">@{{ number }} </td>
                                            <td class="col-md-2 text-center">@{{ applyleave.person.name }}</td>
                                            <td class="col-md-2">@{{ applyleave.person.position.name }}</td>
                                            <td class="col-md-2 text-center">@{{ applyleave.leave_type }}</td>
                                            <td class="col-md-2 text-center">@{{ applyleave.created_at }}</td>
                                            <td class="col-md-1 text-center">@{{ applyleave.status }}</td>
                                            <td class="col-md-1 text-center">
                                                <a href="/applyleave/@{{ applyleave.id }}/edit" class="btn btn-sm btn-primary">Edit</a>
                                                {{-- <button class="btn btn-danger btn-sm btn-delete" ng-click="confirmDelete(leave.id)">Delete</button> --}}
                                            </td>
                                        </tr>
                                        <tr ng-show="(applyleaves | filter:search).length == 0 || ! applyleaves.length">
                                            <td colspan="8" class="text-center">No Records Found!</td>
                                        </tr>                         

                                    </tbody>
                                </table>            
                            </div>
                        </div>
                        <div class="panel-footer">
                              <dir-pagination-controls max-size="5" direction-links="true" boundary-links="true" class="pull-left" pagination-id="1"> </dir-pagination-controls>
                              <label class="pull-right totalnum" for="totalnum">Showing @{{(leaves | filter:search).length}} of @{{leaves.length}} entries</label> 
                        </div>
                    </div>
                </div>
                {{-- End of Leave Application --}}            

                {{-- Leave Setting --}}
                <div class="tab-pane" id="setting">
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
                                <div class="pull-right">
                                    <a href="/leave/create" class="btn btn-success" name="btn_create">+ New Leave Setup</a>
                                </div>                                
                            </div>
                        </div>

                        <div class="panel-body">
                            <div style="padding-bottom: 10px">
                                <label for="search_name" class="search">Search Name 名字:</label>
                                <input type="text" ng-model="search.person.name">
                                <label for="search_contact" class="search" style="padding-left: 10px">Position 职位:</label>
                                <input type="text" ng-model="search.person.positon.name">
                            </div>
                            <div class="table-responsive">
                                <table class="table table-list-search table-hover table-bordered">
                                    <tr style="background-color: #DDFDF8">
                                        <th class="col-md-1 text-center">
                                            #
                                        </th>                    
                                        <th class="col-md-2 text-center">
                                        <a href="" ng-click="sortType = 'person.name'; sortReverse = !sortReverse">
                                            Name 
                                            <br>
                                            名字
                                        <span ng-show="sortType == 'person.name' && !sortReverse" class="fa fa-caret-down"></span>
                                        <span ng-show="sortType == 'person.name' && sortReverse" class="fa fa-caret-up"></span>
                                        </th>
                                        <th class="col-md-2 text-center">
                                        <a href="" ng-click="sortType = 'person.position.name'; sortReverse = !sortReverse">
                                            Position 
                                            <br>
                                            职位
                                        <span ng-show="sortType == 'person.position.name' && !sortReverse" class="fa fa-caret-down"></span>
                                        <span ng-show="sortType == 'person.position.name' && sortReverse" class="fa fa-caret-up"></span>
                                        </th>                                                
                                        <th class="col-md-2 text-center">
                                        <a href="" ng-click="sortType = 'total_paidleave'; sortReverse = !sortReverse">
                                            Paid Leave 
                                            <br>
                                            带薪年假
                                        <span ng-show="sortType == 'total_paidleave' && !sortReverse" class="fa fa-caret-down"></span>
                                        <span ng-show="sortType == 'total_paidleave' && sortReverse" class="fa fa-caret-up"></span>
                                        </th>
                                        <th class="col-md-2 text-center">
                                        <a href="" ng-click="sortType = 'total_paidsickleave'; sortReverse = !sortReverse">
                                            Sick Leave 
                                            <br>
                                            门诊带薪病假 
                                        <span ng-show="sortType == 'total_paidsickleave' && !sortReverse" class="fa fa-caret-down"></span>
                                        <span ng-show="sortType == 'total_paidsickleave' && sortReverse" class="fa fa-caret-up"></span>
                                        </th>
                                        <th class="col-md-2 text-center">
                                        <a href="" ng-click="sortType = 'total_paidhospleave'; sortReverse = !sortReverse">
                                            Hospt Leave 
                                            <br>
                                            住院带薪病假
                                        <span ng-show="sortType == 'total_paidhospleave' && !sortReverse" class="fa fa-caret-down"></span>
                                        <span ng-show="sortType == 'total_paidhospleave' && sortReverse" class="fa fa-caret-up"></span>
                                        </th>                                                        
                                         <th class="col-md-1 text-center">
                                            Action
                                        </th>                                                                                                
                                    </tr>

                                    <tbody>
                                        <tr dir-paginate="leave in leaves | filter:search | orderBy:sortType:sortReverse | itemsPerPage:itemsPerPage2"  current-page="currentPage2" ng-controller="repeatController2" pagination-id="2">
                                            <td class="col-md-1 text-center">@{{ number }} </td>
                                            <td class="col-md-2 text-center">@{{ leave.person.name }}</td>
                                            <td class="col-md-2 text-center">@{{ leave.person.position.name }}</td>
                                            <td class="col-md-2 text-center">@{{ leave.total_paidleave }}</td>
                                            <td class="col-md-2 text-center">@{{ leave.total_paidsickleave }}</td>
                                            <td class="col-md-2 text-center">@{{ leave.total_paidhospleave }}</td>
                                            <td class="col-md-1 text-center">
                                                <a href="/leave/@{{ leave.id }}/edit" class="btn btn-sm btn-primary">Edit</a>
                                                {{-- <button class="btn btn-danger btn-sm btn-delete" ng-click="confirmDelete(leave.id)">Delete</button> --}}
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
                              <dir-pagination-controls max-size="5" direction-links="true" boundary-links="true" class="pull-left" pagination-id="2"> </dir-pagination-controls>
                              <label class="pull-right totalnum" for="totalnum">Showing @{{(leaves | filter:search).length}} of @{{leaves.length}} entries</label> 
                        </div>
                    </div>
                </div>
                {{-- End of Leave Setting --}}
            </div>
        </div>
    </div>
    </div>
 
    <script src="/js/leave.js"></script>  
@stop