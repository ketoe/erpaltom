(function () {
angular.module('altomApp', [])

.controller('NewMeasureCtrl', ['$scope','$http', function ($scope, $http) {

	$scope.order = {};
	$scope.clients = {};
	$scope.messages = null;
	$scope.filterBy = {};



	$http.get('/Clients/getClientsJson')
			.success(function (data) {
				$scope.clients = data;
			});

	

}]);
})();