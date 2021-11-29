(function () {
angular.module('altomApp', [])

.controller('ClientsListCtrl', ['$scope','$http', function ($scope, $http) {


	$scope.orders = [];
	$scope.orderByColumn = 'id';
	$scope.orderByDir = true;
	$scope.filterBy = {};
	$scope.users = [];


	$http.get('/Clients/getClientsJson/')
			.success(function (data) {
				$scope.clients = data;
			});


}]);
})();