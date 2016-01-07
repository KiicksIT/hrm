var app = angular.module('app', ['ui.bootstrap', 'angularUtils.directives.dirPagination']);

    function departmentController($scope, $http){

        // retrieve payslip id
        var department_id = $('#department_id').val();        
        $scope.currentPage = 1;
        $scope.itemsPerPage = '';


        $http.get('/department/people/' + department_id ).success(function(people){
            $scope.people = people;
        });

    }     

app.controller('departmentController', departmentController);
