var app = angular.module('app', ['ui.bootstrap', 'angularUtils.directives.dirPagination', 'ui.select', 'ngSanitize']);

    function personAttsController($scope, $http){

            $scope.basicModel = 0;
            $scope.basicRateModel = 0;
            $scope.otRateModel = 0;
            $scope.residentModel = 0;
            $scope.totalEarnedModel = 0;

            $http.get('/api/personatts/'+ $('#person_id').val()).success(function(personatts){

                $scope.basicModel = personatts.basic != 0 ? personatts.basic : personatts.person.basic;

                $scope.basicRateModel = personatts.basic_rate != 0 ? personatts.basic_rate : personatts.person.basic_rate;

                $scope.otRateModel = personatts.ot_rate != 0 ? personatts.ot_rate : personatts.person.ot_rate;

                $scope.residentModel = personatts.resident ? personatts.resident : personatts.person.resident;

                $scope.totalEarnedModel = personatts.total_earned != 0 ? personatts.total_earned : personatts.person.total_earned;
            });


    }

app.controller('personAttsController', personAttsController);
