var app = angular.module('app', ['ui.bootstrap', 'angularUtils.directives.dirPagination']);

    function schedulerController($scope, $http){

        $scope.currentPage = 1;
        $scope.itemsPerPage = 10;         

        angular.element(document).ready(function () {
       
            $http.get('/scheduler/data1').success(function(schedulers){
            $scope.schedulers = schedulers;
            });

            $http.get('/scheduler/data2').success(function(cschedulers){
            $scope.cschedulers = cschedulers;
            });            

            //delete record
            $scope.confirmDelete = function(id){
                var isConfirmDelete = confirm('Are you sure you want to delete entry ID: ' + id);
                if(isConfirmDelete){
                    $http({
                        method: 'DELETE',
                        url: '/scheduler/data/' + id
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

function repeatController($scope) {
    $scope.$watch('$index', function(index) {
        $scope.number = ($scope.$index + 1) + ($scope.currentPage - 1) * $scope.itemsPerPage;
    })
}    

app.controller('schedulerController', schedulerController);
app.controller('repeatController', repeatController);
