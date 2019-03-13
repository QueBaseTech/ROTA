var app = angular.module("myApp", []);
app.controller("userCtrl", function($scope, $http){
	$scope.passw1 = '';
	$scope.passw2 = '';
	$scope.userName = '';
	$scope.edit = true;
	$scope.error = true;
	$scope.incomplete = true;
	$scope.hideform = false;

	$scope.$watch('passw1',function() {$scope.test();});
	$scope.$watch('passw2',function() {$scope.test();});
	$scope.$watch('userName', function() {$scope.test();});

	$scope.test = function() {
	  if ($scope.passw1 !== $scope.passw2) {
	    $scope.error = true;
	    } else {
	    $scope.error = false;
	  }
	  $scope.incomplete = false;
	  if ($scope.edit && (!$scope.userName.length || !$scope.passw1.length || !$scope.passw2.length)) {
	     $scope.incomplete = true;
	  }
	};


	//User Authentication
	$scope.loginUser = function() {

	$http.post('php/login.php', 
		{
		    'userName'  : $scope.userName, 
		   	'userPassword' : $scope.passw1
		}
	)
		    
	.then(function successCallback(response){
		if(response.success == true) {
			console.log(response.status);
			}else{
			console.log(response.data.success);
			}
	}, function errorCallback(){
		console.log(response);
	});
  }
});
