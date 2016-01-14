@extends('template')
@section('title')
{{ $APPLEAVE_TITLE }}
@stop
@section('content')
    
    <div class="row">        
    <a class="title_hyper pull-left" href="/applyleave"><h1> {{ $APPLEAVE_TITLE }}<i class="fa fa-calendar-times-o"></i></h1></a>
    </div>
    <div ng-app="app" ng-controller="applyleaveController">

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
                        <a href="/applyleave/create" class="btn btn-success" name="btn_create">+ {{ $APPLEAVE_TITLE }}</a>
                    </div>                    
                </div>
            </div>

            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-list-search table-bordered">
                        <tr style="background-color: #f5f5dc">
                            <th class="col-md-4 text-center">
                                Available Paid Leave Day(s)
                                <br>
                                可申请带薪年假(天)
                            </th>
                            <th class="col-md-4 text-center">
                                Available Paid Sick Leave Day(s)
                                <br>
                                可申请门诊带薪病假(天)
                            </th>
                            <th class="col-md-4 text-center">
                                Available Paid Hospotalisation Leave Day(s)
                                <br>
                                可申请住院带薪病假(天)
                            </th>                                        
                        </tr>
                        <tbody>
                            <tr>
                                <td class="col-md-4 text-center">
                                    {{$person->leave->total_paidleave}}
                                </td>
                                <td class="col-md-4 text-center">
                                    {{$person->leave->total_paidsickleave}}
                                </td>
                                <td class="col-md-4 text-center">
                                    {{$person->leave->total_paidhospleave}}
                                </td>                                                 
                            </tr>
                        </tbody>
                    </table>    
                </div> 
                <p style="margin-top:-10px"><em>*Be Deducted after Status have been confirmed</em></p>
                           
                <div style="padding: 20px 0px 10px 0px;">
                    <label for="search_name" class="search">Search Leave Date From 从:</label>
                    <input type="text" ng-model="search.leave_from">
                    <label for="search_company" class="search" style="padding-left: 10px">Leave Date To 到:</label>
                    <input type="text" ng-model="search.leave_to">
                    <label for="search_contact" class="search" style="padding-left: 10px">Apply On 申请日:</label>
                    <input type="text" ng-model="search.created_at">
                </div>
                <div class="table-responsive">
                    <table class="table table-list-search table-hover table-bordered">
                        <tr style="background-color: #DDFDF8">
                            <th class="col-md-1 text-center">
                                #
                            </th>                    
                            <th class="col-md-3 text-center">
                                Reason
                                <br> 
                                原因                                                  
                            </th>
                            <th class="col-md-2 text-center">
                                Leave Type 
                                <br>
                                假期种类                     
                            </th>
                            <th class="col-md-1 text-center">
                                Leave From 从
                            </th>                                                
                            <th class="col-md-1 text-center">
                                Leave To 到
                            </th>
                            <th class="col-md-1 text-center">
                                Status 
                                <br>
                                状态
                            </th>
                            <th class="col-md-1 text-center">
                                Applied On 
                                <br>
                                申请日
                            </th>                                                        
                            <th class="col-md-2 text-center">
                                Action
                            </th>                                                                                                
                        </tr>

                        <tbody>
                            <tr dir-paginate="applyleave in applyleaves | filter:search | orderBy:sortType:sortReverse | itemsPerPage:itemsPerPage"  current-page="currentPage" ng-controller="repeatController">
                                <td class="col-md-1 text-center">@{{ number }} </td>
                                <td class="col-md-2">@{{ applyleave.reason }}</td>
                                <td class="col-md-2">@{{ applyleave.leave_type }}</td>
                                <td class="col-md-2 text-center">@{{ applyleave.leave_from }}</td>
                                <td class="col-md-2 text-center">@{{ applyleave.leave_to }}</td>
                                <td class="col-md-1 text-center">@{{ applyleave.status }}</td>
                                <td class="col-md-1 text-center">@{{ applyleave.created_at }}</td>
                                <td class="col-md-1 text-center">
                                    <a href="/applyleave/@{{ applyleave.id }}/edit" class="btn btn-sm btn-primary">View</a>
                                    {{-- <button class="btn btn-danger btn-sm btn-delete" ng-click="confirmDelete(applyleave.id)">Delete</button> --}}
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
                      <dir-pagination-controls max-size="5" direction-links="true" boundary-links="true" class="pull-left"> </dir-pagination-controls>
                      <label class="pull-right totalnum" for="totalnum">Showing @{{(applyleaves | filter:search).length}} of @{{applyleaves.length}} entries</label> 
                </div>
        </div>
    </div>  
    <script src="/js/applyleave.js"></script>  
@stop