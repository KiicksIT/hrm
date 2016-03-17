var app = angular.module('app', ['ui.bootstrap', 'angularUtils.directives.dirPagination', 'ui.select', 'ngSanitize']);

    function payslipController($scope, $http){
        $scope.currentPage = 1;
        $scope.itemsPerPage = 10;
        $scope.people = '';
        $scope.months = [];


            var monthNames = [ 'January', 'February', 'March', 'April', 'May', 'June',
                'July', 'August', 'September', 'October', 'November', 'December' ];


                for (i = 0; i < monthNames.length; i++){
                    $scope.months.push({
                        id: i, name: monthNames[i], year: moment().year()
                    });
                }

            // init


            $scope.onMonthSelected = function (month){

                var month = parseInt(month);
                var numberPattern = /\d+/g;

                $http.get('/person/createData/' + month).success(function(people){
                    $scope.people = people;
                });

                $http.get('/profile/data').success(function(profile){
                    var payday = profile.payday.match(numberPattern);
                    $scope.pdateModel = moment().month(month).date(payday).format('YYYY-MM-DD');
                });

                $scope.pfromModel = moment().month(month).startOf('month').format('YYYY-MM-DD');
                $scope.ptoModel = moment().month(month).endOf('month').format('YYYY-MM-DD');
                $scope.ofromModel = moment().month(month).startOf('month').format('YYYY-MM-DD');
                $scope.otoModel = moment().month(month).endOf('month').format('YYYY-MM-DD');

            }
    }

app.controller('payslipController', payslipController);

