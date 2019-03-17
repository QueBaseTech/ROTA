
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
		if(response.data.sucess == true) {
			//redirect with username data as the unique identifier
				var myRedirect = function(redirectUrl, arg, value) {
				  var form = $('<form action="' + redirectUrl + '" method="post">' +
				  '<input type="hidden" name="'+ arg +'" value="' + value + '"></input>' + '</form>');
				  $('body').append(form);
				  $(form).submit();
				};

				var userName = response.config.data.userName;
				if (userName !== "admin") {
					myRedirect("Members", "userName" , "userName");
				}else{
					myRedirect("Admin", "userName" , "userName");
				}			

			}else{
			console.log("User name or password error");
			}
	}, function errorCallback(){
		console.log(response);
	});
  }
});
