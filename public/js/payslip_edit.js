var app = angular.module('app', [   'ui.bootstrap',
                                    'angularUtils.directives.dirPagination',
                                    'ui.select',
                                    'ngSanitize'
                                ]);

    function payslipController($scope, $http){

        // default constructor
        $scope.currentPage1 = 1;
        $scope.itemsPerPage1 = 5;
        $scope.currentPage2 = 1;
        $scope.itemsPerPage2 = 5;
        $scope.currentPage3 = 1;
        $scope.itemsPerPage3 = 5;
        $scope.basicModel = 0.00;
        $scope.otRateModel = 0.00;
        $scope.totalAddModel = 0.00;
        $scope.totalDeductModel = 0.00;
        $scope.ottotalModel = 0.00;
        $scope.totalAddotherModel = 0.00;
        $scope.netPayModel = 0.00;


        // retrieve payslip id
        var payslip_id = $('#payslip_id').val();

        // init loading
        // ot model get data
        $http.get('/payslip/' + payslip_id).success(function(payslip){

            // retrieve worked ot hour
            $scope.othourModel = payslip.ot_hour;

            // retrieve employee cpf
            $scope.employerEpfModel = payslip.employercont_epf ? payslip.employercont_epf : 'Not Applicable';

            // retrieve total ot pay
            $scope.ottotalModel = payslip.ot_total;

            // retrieve basic pay
            if(payslip.basic){

                $scope.basicModel = payslip.basic;

            }else{

                if(payslip.person.personatts){

                    $scope.basicModel = payslip.person.personatts.basic;

                }else{

                    $scope.basicModel = payslip.person.basic;
                }

            }

            // retrieve rate
            if(payslip.person.personatts){

                $scope.basicRateModel = payslip.person.personatts.basic_rate != 0 ? payslip.person.personatts.basic_rate : payslip.person.basic_rate;

                $scope.otRateModel = payslip.person.personatts.ot_rate != 0 ? payslip.person.personatts.ot_rate : payslip.person.ot_rate;

                $scope.residentModel = payslip.person.personatts.resident == 1 ? 'Yes' : 'No';

            }else{

                $scope.basicRateModel = payslip.person.basic_rate;

                $scope.otRateModel = payslip.person.ot_rate;

                $scope.residentModel = payslip.person.resident == 1 ? 'Yes' : 'No';
            }

            // retrieve net pay
            $scope.netPayModel = payslip.net_pay;

            // worked ot pay
            $scope.onOtHourChange = function(){
                $scope.ottotalModel = ($scope.othourModel * $scope.otRateModel * $scope.basicRateModel).toFixed(2);
            }

            // addition
            $http.get('/payslip/addition/' + payslip_id).success(function(additions){
                $scope.additions = additions;

                // calculate cumulative add total
                var totaladd = 0;
                for(var i = 0; i < $scope.additions.length; i++){
                    var addition = $scope.additions[i];
                    totaladd += (addition.add_amount/100*100);
                }
                $scope.totalAddModel = totaladd.toFixed(2);

            });

            // deduction
            $http.get('/payslip/deduction/' + payslip_id).success(function(deductions){
                $scope.deductions = deductions;

                // calculate cumulative deduct total
                var totaldeduct = 0;
                for(var i = 0; i < $scope.deductions.length; i++){
                    var deduction = $scope.deductions[i];
                    totaldeduct += (deduction.deduct_amount/100*100);
                }
                $scope.totalDeductModel = totaldeduct.toFixed(2);

            });

            // addother
            $http.get('/payslip/addother/' + payslip_id).success(function(addothers){
                $scope.addothers = addothers;

                // calculate cumulative addother total
                var totaladdother = 0;
                for(var i = 0; i < $scope.addothers.length; i++){
                    var addother = $scope.addothers[i];
                    totaladdother += (addother.addother_amount/100*100);
                }
                $scope.totalAddotherModel = totaladdother.toFixed(2);

            });
        });

        //delete all record
        $scope.confirmDelete = function(id){
            var isConfirmDelete = confirm('Are you sure you want to delete entry ID: ' + id);
            if(isConfirmDelete){
                $http({
                    method: 'DELETE',
                    url: '/payslip/data/' + id
                })
                .success(function(data){
                    history.back();
                    location.reload();
                })
                .error(function(data){
                    alert('Unable to delete');
                })
            }else{
                return false;
            }
        }

        //delete record for addition
        $scope.confirmDelete1 = function(id){
            var isConfirmDelete = confirm('Are you sure you want to delete entry ID: ' + id);
            if(isConfirmDelete){
                $http({
                    method: 'DELETE',
                    url: '/addition/data/' + id
                })
                .success(function(data){
                    location.reload();
                })
                .error(function(data){
                    alert('Unable to delete');
                })
            }else{
                return false;
            }
        }

        //delete record for deduction
        $scope.confirmDelete2 = function(id){
            var isConfirmDelete = confirm('Are you sure you want to delete entry ID: ' + id);
            if(isConfirmDelete){
                $http({
                    method: 'DELETE',
                    url: '/deduction/data/' + id
                })
                .success(function(data){
                    location.reload();
                })
                .error(function(data){
                    alert('Unable to delete');
                })
            }else{
                return false;
            }
        }

        //delete record for addother
        $scope.confirmDelete3 = function(id){
            var isConfirmDelete = confirm('Are you sure you want to delete entry ID: ' + id);
            if(isConfirmDelete){
                $http({
                    method: 'DELETE',
                    url: '/addother/data/' + id
                })
                .success(function(data){
                    location.reload();
                })
                .error(function(data){
                    alert('Unable to delete');
                })
            }else{
                return false;
            }
        }
    }



function repeatController1($scope) {
    $scope.$watch('$index', function(index) {
        $scope.number = ($scope.$index + 1) + ($scope.currentPage1 - 1) * $scope.itemsPerPage1;
    })
}

function repeatController2($scope) {
    $scope.$watch('$index', function(index) {
        $scope.number = ($scope.$index + 1) + ($scope.currentPage2 - 1) * $scope.itemsPerPage2;
    })
}

function repeatController3($scope) {
    $scope.$watch('$index', function(index) {
        $scope.number = ($scope.$index + 1) + ($scope.currentPage3 - 1) * $scope.itemsPerPage3;
    })
}

app.controller('payslipController', payslipController);
app.controller('repeatController1', repeatController1);
app.controller('repeatController2', repeatController2);
app.controller('repeatController3', repeatController3);
