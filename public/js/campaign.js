var app = angular.module('app', ['ui.bootstrap', 'angularUtils.directives.dirPagination']);

    function campaignController($scope, $http){

        $scope.currentPage = 1;
        $scope.itemsPerPage = 10;         

        angular.element(document).ready(function () {
       
            $http.get('/campaign/data').success(function(campaigns){
            $scope.campaigns = campaigns;
            });

            //delete record
            $scope.confirmDelete = function(id){
                var isConfirmDelete = confirm('Are you sure you want to delete entry ID: ' + id);
                if(isConfirmDelete){
                    $http({
                        method: 'DELETE',
                        url: '/campaign/data/' + id
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

app.controller('campaignController', campaignController);
app.controller('repeatController', repeatController);
