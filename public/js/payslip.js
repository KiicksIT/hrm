var app = angular.module('app', ['ui.bootstrap', 'angularUtils.directives.dirPagination', 'ui.select', 'ngSanitize']);

    function payslipController($scope, $http){
        $scope.currentPage = 1;
        $scope.itemsPerPage = 10;  

        angular.element(document).ready(function () {

            $scope.basicModel = [];
            // init
            $http.get('/person/data').success(function(people){
                $scope.people = people;                 
            });                                 

            $scope.onPersonSelected = function (person){

                $http({
                    url: '/payslip/person/'+ person.id,
                    method: "GET",

                }).success(function(person){
                    console.log(person);
                    
                    $scope.basicModel = person.basic;
                });                    

            } 
        });
    }    

app.controller('payslipController', payslipController);

