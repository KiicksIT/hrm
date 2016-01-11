var app = angular.module('app', ['ui.bootstrap', 'angularUtils.directives.dirPagination']);

    function leaveController($scope, $http){

    $scope.currentPage1 = 1;
    $scope.itemsPerPage1 = 10; 
    $scope.currentPage2 = 1;
    $scope.itemsPerPage2 = 10;            
        
        $http.get('/applyleaves/data').success(function(applyleaves){
        $scope.applyleaves = applyleaves;
        });        

        $http.get('/leave/data').success(function(leaves){
        $scope.leaves = leaves;
        });

        //delete record
        $scope.confirmDelete = function(id){
            var isConfirmDelete = confirm('Are you sure you want to delete entry ID: ' + id);
            if(isConfirmDelete){
                $http({
                    method: 'DELETE',
                    url: '/leave/data/' + id
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

app.controller('leaveController', leaveController);
app.controller('repeatController1', repeatController1);
app.controller('repeatController2', repeatController2);
