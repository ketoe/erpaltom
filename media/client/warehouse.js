(function () {
angular.module('altomApp', [])

.controller('WarehouseCtrl', ['$scope','$http', function ($scope, $http) {


	$scope.article = [];
	$scope.orderByColumn = 'id';
	$scope.orderByDir = true;
	$scope.filterBy = {};
	$scope.users = [];


	$http.get('/Warehouse/getWarehouseJson/')
		.success(function (data) {
			$scope.articles = data;
		});
	

}]);
})();