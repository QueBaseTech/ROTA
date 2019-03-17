var app = angular.module('myApp', []);
app.controller('adminCtrl', function($scope, $http) {
	console.log("Holla");
    $http.get("../php/getUsersInfo.php")
    .then(function (response) {
    	$scope.records = response.data.records;
    	console.log(response);
    });
});