var app = angular.module('app', ['ui.bootstrap', 'angularUtils.directives.dirPagination']);

    function leaveController($scope, $http){

    $scope.currentPage = 1;
    $scope.itemsPerPage = 10;        
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

function repeatController($scope) {
    $scope.$watch('$index', function(index) {
        $scope.number = ($scope.$index + 1) + ($scope.currentPage - 1) * $scope.itemsPerPage;
    })
}    

app.controller('leaveController', leaveController);
app.controller('repeatController', repeatController);
