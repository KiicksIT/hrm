var app = angular.module('app', ['ui.bootstrap', 'angularUtils.directives.dirPagination']);

    function departmentController($scope, $http){

    $scope.currentPage = 1;
    $scope.itemsPerPage = 10;        
        $http.get('/department/data').success(function(departments){
        $scope.departments = departments;
        });

        //delete record
        $scope.confirmDelete = function(id){
            var isConfirmDelete = confirm('Are you sure you want to delete entry ID: ' + id);
            if(isConfirmDelete){
                $http({
                    method: 'DELETE',
                    url: '/department/data/' + id
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
    }  

function repeatController($scope) {
    $scope.$watch('$index', function(index) {
        $scope.number = ($scope.$index + 1) + ($scope.currentPage - 1) * $scope.itemsPerPage;
    })
}    

app.controller('departmentController', departmentController);
app.controller('repeatController', repeatController);
