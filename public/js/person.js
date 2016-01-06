var app = angular.module('app', ['ui.bootstrap', 'angularUtils.directives.dirPagination']);

$('.checkall').change(function(){
    var all = this;
    $(this).closest('table').find('input[type="checkbox"]').prop('checked', all.checked);
});

    function personController($scope, $http){

        $scope.currentPage = 1;
        $scope.itemsPerPage = 10; 
        $scope.selected = [];

        // send email by checkbox
        $scope.check= function(data) { 
        var arr = [];
        for(var i in data){
           if(data[i].SELECTED=='Y'){
               arr.push(data[i].email);
           }
        }    
        // find selected checkbox and send mail
        $scope.selected = arr;

            if(arr.length > 0){
                var link = "mailto:"+arr;
                window.location.href = link;
            }
        }    

        // Check/uncheck all boxes
     /*   $scope.checkAll = function () {
            if ($scope.selectAll) {
                $scope.selectAll = true;
            } else {
                $scope.selectAll = false;
            }
            angular.forEach($scope.people, function (person) {
                person.SELECTED = $scope.selectAll;
            });

        }; */
                         

        angular.element(document).ready(function () {
       
            $http.get('/person/data').success(function(people){
            $scope.people = people;
            });

            //delete record
            $scope.confirmDelete = function(id){
                var isConfirmDelete = confirm('Are you sure you want to delete entry ID: ' + id);
                if(isConfirmDelete){
                    $http({
                        method: 'DELETE',
                        url: '/person/data/' + id
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
        });
    }  

function repeatController($scope) {
    $scope.$watch('$index', function(index) {
        $scope.number = ($scope.$index + 1) + ($scope.currentPage - 1) * $scope.itemsPerPage;
    })
}   

/*$(document).ready(function () {
    $(".checkall").click(function () {
        $(".check").prop('checked', $(this).prop('checked'));
    });
}); */

app.controller('personController', personController);
app.controller('repeatController', repeatController);
