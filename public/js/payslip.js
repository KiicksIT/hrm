var app = angular.module('app', ['ui.bootstrap', 'angularUtils.directives.dirPagination', 'ui.select', 'ngSanitize']);

    function payslipController($scope, $http){
        $scope.currentPage = 1;
        $scope.itemsPerPage = 10;
        $scope.people = '';
        $scope.months = [];

        angular.element(document).ready(function () {

            $http.get('/api/months').success(function(response) {
                for (i = 0; i < response.length; i++){
                    $scope.months.push({
                        id: response[i].id, name: response[i].name, year: moment().year()-1
                    });
                }
                for (i = 0; i < response.length; i++){
                    $scope.months.push({
                        id: response[i].id, name: response[i].name, year: moment().year()
                    });
                }
                for (i = 0; i < response.length; i++){
                    $scope.months.push({
                        id: response[i].id, name: response[i].name, year: moment().year()+1
                    });
                }
            });

            $scope.onMonthSelected = function (months){
                var timeline = months.split('-', 2);
                var month = parseInt(timeline[0]);
                var year = parseInt(timeline[1]);

                $http.get('/person/createData/' + month + '/' + year).success(function(people){
                    $scope.people = people;
                });
            }

            $('.select').select2({
                placeholder: 'Select...',
                allowClear: true
            });
        });
    }

app.controller('payslipController', payslipController);

