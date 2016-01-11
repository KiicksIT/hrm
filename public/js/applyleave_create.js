var app = angular.module('app', ['ui.bootstrap', 'angularUtils.directives.dirPagination', 'ui.select', 'ngSanitize']);

    function applyleaveController($scope, $http){
        $scope.currentPage = 1;
        $scope.itemsPerPage = 10;  

        angular.element(document).ready(function () {

            $http.get('/person/data').success(function(people){
                $scope.people = people;                 
            });                                 

        });
    }    

app.controller('applyleaveController', applyleaveController);

