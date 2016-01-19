@inject('profile', 'App\Profile')

@extends('template')
@section('title')
{{ $PAYSLIP_TITLE }}
@stop
@section('content')
    
    <div class="row">        
    <a class="title_hyper pull-left" href="/payslip"><h1>{{ $PAYSLIP_TITLE }} <i class="fa fa-credit-card"></i></h1></a>
    </div>
    <div ng-app="app" ng-controller="payslipController">

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">

                    <div class="pull-left display_num">
                        <label for="display_num">Display</label>
                        <select ng-model="itemsPerPage" ng-init="itemsPerPage='10'">
                          <option>10</option>
                          <option>20</option>
                          <option>30</option>
                        </select>
                        <label for="display_num2" style="padding-right: 20px">per Page</label>
                    </div>

                    <div class="pull-right">
                        <a href="/profile/{{$profile::firstOrFail()->id}}/edit/policy" class="btn btn-primary">Payslip Policy 薪水单选项</a>                    
                        <a href="/payslip/create" class="btn btn-success" name="btn_create">+ New {{ $PAYSLIP_TITLE }}</a>
                    </div>
                </div>
            </div>

            <div class="panel-body">
            <div class="row">
                <div style="padding-bottom: 10px">
                    <label for="search_name" class="search" style="padding-left: 16px">Search Name 名字:</label>
                    <input type="text" ng-model="search.name">
                    <label for="search_status" class="search" style="padding-left: 10px">Position 职位:</label>
                    <input type="text" ng-model="search.person.position.name">                     
                    <label for="search_status" class="search" style="padding-left: 10px">Status 状态:</label>
                    <input type="text" ng-model="search.status">                    
                </div>
            </div>      

                <div class="table-responsive">
                    <table class="table table-list-search table-hover table-bordered">
                        <tr style="background-color: #DDFDF8">
                            <th class="col-md-1 text-center">
                                #
                            </th>                                        
                            <th class="col-md-3 text-center">
                                <a href="#" ng-click="sortType = 'name'; sortReverse = !sortReverse">
                                Name 
                                <br>
                                名字
                                <span ng-show="sortType == 'name' && !sortReverse" class="fa fa-caret-down"></span>
                                <span ng-show="sortType == 'name' && sortReverse" class="fa fa-caret-up"></span>
                            </th>
                            <th class="col-md-2 text-center">
                                Position 
                                <br>
                                职位                      
                            </th>
                            <th class="col-md-1 text-center">
                                <a href="#" ng-click="sortType = 'status'; sortReverse = !sortReverse">                         
                                Status 
                                <br>
                                状态
                                <span ng-show="sortType == 'status' && !sortReverse" class="fa fa-caret-down"></span>
                                <span ng-show="sortType == 'status' && sortReverse" class="fa fa-caret-up"></span>                          
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
                            <tr dir-paginate="payslip in payslips | filter:search | orderBy:sortType:sortReverse | itemsPerPage:itemsPerPage"  current-page="currentPage" ng-controller="repeatController">
                                <td class="col-md-1 text-center">@{{ number }} </td>
                                <td class="col-md-3 text-center">
                                <a href="/person/@{{ payslip.person.id }}">
                                @{{ payslip.person.name }}
                                </a>
                                </td>
                                {{-- <td class="col-md-2 text-center">@{{ payslip.person.department.name }}</td> --}}
                                <td class="col-md-2 text-center">@{{ payslip.person.position.name }}</td>                                
                                <td class="col-md-1 text-center">@{{ payslip.status }}</td>
                                <td class="col-md-2 text-center">@{{ payslip.created_at }}</td>
                                <td class="col-md-2 text-center">
                                        <a href="/payslip/@{{ payslip.id }}/edit" class="btn btn-sm btn-primary">Edit</a>
                                        <button class="btn btn-danger btn-sm btn-delete" ng-click="confirmDelete(payslip.id)">Delete</button>  
                                </td>
                            </tr>
                            <tr ng-show="(payslips | filter:search).length == 0 || ! payslips.length">
                                <td colspan="10" class="text-center">No Records Found</td>
                            </tr>                         

                        </tbody>
                    </table>
                </div>            
            </div>
                <div class="panel-footer">
                      <dir-pagination-controls max-size="5" direction-links="true" boundary-links="true" class="pull-left"> </dir-pagination-controls>
                      <label class="pull-right totalnum" for="totalnum">Showing @{{(payslips | filter:search).length}} of @{{payslips.length}} entries</label> 
                </div>
        </div>
    </div>  
    <script src="/js/payslip_index.js"></script>  
@stop