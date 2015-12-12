@extends('template')
@section('title')
{{ $CAMPAIGN_TITLE }}
@stop
@section('content')
    
    <div class="row">        
    <a class="title_hyper pull-left" href="/campaign"><h1>{{ $CAMPAIGN_TITLE }} <i class="fa fa-newspaper-o"></i></h1></a>
    </div>
    <div ng-app="app" ng-controller="campaignController">

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
                        <a href="/campaign/create" class="btn btn-success">+ New {{ $CAMPAIGN_TITLE }}</a>                        
                    </div>
                </div>
            </div>

            <div class="panel-body">
                <div style="padding-bottom: 10px">
                    <label for="search_name" class="search">Search Event:</label>
                    <input type="text" ng-model="search.name">
                    <label for="search_contact" class="search" style="padding-left: 10px">Status:</label>
                    <input type="text" ng-model="search.status">
                </div>
                <div class="table-responsive">
                    <table class="table table-list-search table-hover table-bordered">
                        <tr style="background-color: #DDFDF8">
                            <th class="col-md-1 text-center">
                                #
                            </th>                    
                            <th class="col-md-2 text-center">
                                Event                           
                            </th>
                            <th class="col-md-2 text-center">
                                <a href="#" ng-click="sortType = 'start_date'; sortReverse = !sortReverse">
                                Start On
                                <span ng-show="sortType == 'start_date' && !sortReverse" class="fa fa-caret-down"></span>
                                <span ng-show="sortType == 'start_date' && sortReverse" class="fa fa-caret-up"></span>
                            </th>
                            <th class="col-md-2 text-center">
                                <a href="#" ng-click="sortType = 'end_date'; sortReverse = !sortReverse">
                                Ended On
                                <span ng-show="sortType == 'end_date' && !sortReverse" class="fa fa-caret-down"></span>
                                <span ng-show="sortType == 'end_date' && sortReverse" class="fa fa-caret-up"></span>
                            </th>                            
                            <th class="col-md-2 text-center">
                                <a href="#" ng-click="sortType = 'invest'; sortReverse = !sortReverse">                            
                                Invested
                                <span ng-show="sortType == 'invest' && !sortReverse" class="fa fa-caret-down"></span>
                                <span ng-show="sortType == 'invest' && sortReverse" class="fa fa-caret-up"></span>                                
                            </th>                                                
                             <th class="col-md-1 text-center">
                                Status
                            </th>
                             <th class="col-md-2 text-center">
                                Action
                            </th>                                                                                                
                        </tr>

                        <tbody>
                            <tr dir-paginate="campaign in campaigns | filter:search | orderBy:sortType:sortReverse | itemsPerPage:itemsPerPage"  current-page="currentPage" ng-controller="repeatController">
                                <td class="col-md-1 text-center">@{{ number }} </td>
                                <td class="col-md-2">@{{ campaign.name }}</td>
                                <td class="col-md-2">@{{ campaign.start_date }}</td>
                                <td class="col-md-2">@{{ campaign.end_date }}</td>
                                <td class="col-md-2 text-right">@{{ campaign.invest | currency }}</td>
                                <td class="col-md-1 text-center">@{{ campaign.status }}</td>
                                <td class="col-md-2 text-center">
                                    <div ng-if="campaign.status == 'Proceeding'">
                                        <a href="/campaign/@{{ campaign.id }}/edit" class="btn btn-sm btn-primary">Edit</a>
                                        <button class="btn btn-danger btn-sm btn-delete" ng-click="confirmDelete(campaign.id)">Delete</button>
                                    </div>
                                    <div ng-if="campaign.status == 'Complete'">
                                        <a href="/campaign/@{{ campaign.id }}" class="btn btn-sm btn-default">View</a>
                                    </div>                                    
                                </td>                             
                            </tr>
                            <tr ng-show="(campaigns | filter:search).length == 0 || ! campaigns.length">
                                <td colspan="7" class="text-center">No Records Found</td>
                            </tr>                         

                        </tbody>
                    </table>
                </div>            
            </div>
                <div class="panel-footer">
                      <dir-pagination-controls max-size="5" direction-links="true" boundary-links="true" class="pull-left"> </dir-pagination-controls>
                      <label class="pull-right totalnum" for="totalnum">Showing @{{(campaigns | filter:search).length}} of @{{campaigns.length}} entries</label> 
                </div>
        </div>
    </div>  

    <script src="/js/campaign.js"></script>  
@stop