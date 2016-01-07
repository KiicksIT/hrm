var app = angular.module('app', ['ui.bootstrap', 'angularUtils.directives.dirPagination']);

    function positionController($scope, $http){

        // retrieve payslip id
        var position_id = $('#position_id').val();        
        $scope.currentPage = 1;
        $scope.itemsPerPage = '';


        $http.get('/position/people/' + position_id ).success(function(people){
            $scope.people = people;
        });

    }     

app.controller('positionController', positionController);
