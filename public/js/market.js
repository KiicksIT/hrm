var app = angular.module('app', ['ui.bootstrap', 'angularUtils.directives.dirPagination']);

    function marketController($scope, $http){

        $scope.currentPage1 = 1;
        $scope.itemsPerPage1 = 10; 

        $scope.currentPage2 = 1;
        $scope.itemsPerPage2 = 10; 

        $scope.currentPage3 = 1;
        $scope.itemsPerPage3 = 10;  

        $scope.selected1 = [];
        $scope.selected2 = [];

        // send email by checkbox
        $scope.check1= function(data) { 
        var arr1 = [];
        for(var i in data){
           if(data[i].SELECTED1=='Y'){
               arr1.push(data[i].email);
           }
        }    
        // find selected checkbox and send mail
        $scope.selected1 = arr1;
            if(arr1.length > 0){
                var link = "mailto:"+arr1;
                window.location.href = link;
            }
        }  
        // 2nd one
        // send email by checkbox
        $scope.check2= function(data) { 
        var arr2 = [];
        for(var i in data){
           if(data[i].SELECTED2=='Y'){
               arr2.push(data[i].email);
           }
        }    
        // find selected checkbox and send mail
        $scope.selected2 = arr2;
            if(arr2.length > 0){
                var link = "mailto:"+arr2;
                window.location.href = link;
            }
        }                                         

        angular.element(document).ready(function () {
       
            $http.get('/market/data1').success(function(markets1){
            $scope.markets1 = markets1;
            });

            $http.get('/market/data2').success(function(markets2){
            $scope.markets2 = markets2;
            });   

            $http.get('/market/data3').success(function(markets3){
            $scope.markets3 = markets3;
            });                        

            //delete record
            $scope.confirmDelete = function(id){
                var isConfirmDelete = confirm('Are you sure you want to delete entry ID: ' + id);
                if(isConfirmDelete){
                    $http({
                        method: 'DELETE',
                        url: '/market/data/' + id
                    })
                    .success(function(data){
                        console.log(data);
                        location.reload();
                    })
                    .error(function(data){
                        console.log(data);
                        alert('Unable to delete');
                    })
                }else{
                    return false;
                }
            } 
        });
    }  

$(function() {
    // for bootstrap 3 use 'shown.bs.tab', for bootstrap 2 use 'shown' in the next line
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        // save the latest tab; use cookies if you like 'em better:
        localStorage.setItem('lastTab', $(this).attr('href'));
    });
    // go to the latest tab, if it exists:
    var lastTab = localStorage.getItem('lastTab');
    if (lastTab) {
        $('[href="' + lastTab + '"]').tab('show');
    }
});    

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

app.controller('marketController', marketController);
app.controller('repeatController1', repeatController1);
app.controller('repeatController2', repeatController2);
app.controller('repeatController3', repeatController3);
