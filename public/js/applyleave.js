var app = angular.module('app', ['ui.bootstrap', 'angularUtils.directives.dirPagination']);

    function applyleaveController($scope, $http){

    $scope.currentPage = 1;
    $scope.itemsPerPage = 10;        
        $http.get('/applyleave/data').success(function(applyleaves){
        $scope.applyleaves = applyleaves;
        });

        //delete record
        $scope.confirmDelete = function(id){
            var isConfirmDelete = confirm('Are you sure you want to delete entry ID: ' + id);
            if(isConfirmDelete){
                $http({
                    method: 'DELETE',
                    url: '/applyleave/data/' + id
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

app.controller('applyleaveController', applyleaveController);
app.controller('repeatController', repeatController);
