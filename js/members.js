
var app = angular.module("myApp", []);
app.controller("membersCtrl", function($scope, $http){
	$scope.Date = '';
	$scope.morningDuty = '';
	$scope.morningVenue = '';
	$scope.afternoonDuty = '';
	$scope.afternoonVenue = '';
	$scope.comments = '';	
	$scope.edit = false;
	$scope.hideform = true;

	//Show Form on click for new record
	$scope.newRecord = function(){
		$scope.hideform = false;
		$scope.edit = true;
	}
});
