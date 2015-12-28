var app = angular.module('app', [   'ui.bootstrap', 
                                    'angularUtils.directives.dirPagination',
                                    'ui.select', 
                                    'ngSanitize'
                                ]);

    function payslipController($scope, $http){

        $scope.currentPage1 = 1;
        $scope.itemsPerPage1 = 5; 
        $scope.currentPage2 = 1;
        $scope.itemsPerPage2 = 5; 
        $scope.currentPage3 = 1;
        $scope.itemsPerPage3 = 5;
        $scope.basicModel = 0.00; 
        $scope.totalAddModel = 0.00; 
        $scope.totalDeductModel = 0.00; 
        $scope.ottotalModel = 0.00; 
        $scope.totalAddotherModel = 0.00;  


        // retrieve payslip id
        var payslip_id = $('#payslip_id').val();
        // retrieve ot rate for calculation
        var ot_rate = $('#ot_rate').val();
        // retrieve basic hour for calculation
        var basic_rate = $('#basic_rate').val();

        // ot model get data
        $http.get('/payslip/' + payslip_id).success(function(payslip){
            $scope.othourModel = payslip.ot_hour;
            $scope.employerEpfModel = payslip.employercont_epf;
            $scope.ottotalModel = payslip.ot_total;
            $scope.netPayModel = parseFloat(payslip.basic) + parseFloat(payslip.add_total) 
                - parseFloat(payslip.deduct_total) + parseFloat(payslip.ot_total) + parseFloat(payslip.other_total);
        });


/*        $scope.netPayModel = (parseFloat($scope.basicModel) + parseFloat($scope.totalAddModel) 
            - parseFloat($scope.totalDeductModel) + parseFloat($scope.ottotalModel) + parseFloat($scope.totalAddotherModel)).toFixed(2);
*/
        // find person on this payslip
        $http.get('/payslip/' + payslip_id + '/person').success(function(person){
            $scope.basicModel = person.basic;
            $scope.ageCPF = getAge(person.dob);
            // add all up
            $scope.calTotal = function(){
                $scope.plusAllModel =  (parseFloat($scope.basicModel) +  parseFloat($scope.totalAddModel) + 
                                        parseFloat($scope.ottotalModel) + parseFloat($scope.totalAddotherModel)).toFixed(2);

                if(person.resident == 'Yes'){

                    if($scope.ageCPF <=  50){

                        $scope.employerEpfModel = parseFloat($scope.plusAllModel * 17/100).toFixed(2);

                        $scope.employeeEpfModel = parseFloat($scope.plusAllModel * 20/100).toFixed(2);

                    }else if($scope.ageCPF > 50 && $scope.ageCPF <= 55){

                        $scope.employerEpfModel = parseFloat($scope.plusAllModel * 16/100).toFixed(2);

                        $scope.employeeEpfModel = parseFloat($scope.plusAllModel * 19/100).toFixed(2);

                    }else if($scope.ageCPF > 55 && $scope.ageCPF <= 60){

                        $scope.employerEpfModel = parseFloat($scope.plusAllModel * 12/100).toFixed(2);

                        $scope.employeeEpfModel = parseFloat($scope.plusAllModel * 13/100).toFixed(2);

                    }else if($scope.ageCPF > 60 && $scope.ageCPF <= 65){

                        $scope.employerEpfModel = parseFloat($scope.plusAllModel * 8.5/100).toFixed(2);

                        $scope.employeeEpfModel = parseFloat($scope.plusAllModel * 7.5/100).toFixed(2);

                    }else{

                        $scope.employerEpfModel = parseFloat($scope.plusAllModel * 7.5/100).toFixed(2);

                        $scope.employeeEpfModel = parseFloat($scope.plusAllModel * 5/100).toFixed(2);

                    }                  
                }
                
                return true;
            }         
        });


        // worked ot pay
        $scope.onOtHourChange = function(){
            $scope.ottotalModel = ($scope.othourModel * ot_rate * basic_rate).toFixed(2);
        }       

        // addition
        $http.get('/payslip/addition/' + payslip_id).success(function(additions){
            $scope.additions = additions; 

            // calculate cumulative add total
            var totaladd = 0;
            for(var i = 0; i < $scope.additions.length; i++){
                var addition = $scope.additions[i];
                totaladd += (addition.amount/100*100);
            }
            $scope.totalAddModel = totaladd.toFixed(2);

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


        // deduction
        $http.get('/payslip/deduction/' + payslip_id).success(function(deductions){
            $scope.deductions = deductions;

            // calculate cumulative deduct total
            var totaldeduct = 0;
            for(var i = 0; i < $scope.deductions.length; i++){
                var deduction = $scope.deductions[i];
                totaldeduct += (deduction.amount/100*100);
            }
            $scope.totalDeductModel = totaldeduct.toFixed(2);

        });

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

        // addother
        $http.get('/payslip/addother/' + payslip_id).success(function(addothers){
            $scope.addothers = addothers;

            // calculate cumulative addother total
            var totaladdother = 0;
            for(var i = 0; i < $scope.addothers.length; i++){
                var addother = $scope.addothers[i];
                totaladdother += (addother.amount/100*100);
            }
            $scope.totalAddotherModel = totaladdother.toFixed(2);

        });

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

function getAge(dateString) 
{
    var today = new Date();
    var birthDate = new Date(dateString);
    console.log(birthDate);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) 
    {
        age--;
    }
    return age;
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
