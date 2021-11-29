(function () {
angular.module('altomApp', [])

.controller('WarehouseRotoCtrl', ['$scope','$http', function ($scope, $http) {


	$scope.article = [];
	$scope.orderByColumn = 'id';
	$scope.orderByDir = true;
	$scope.filterBy = {};
	$scope.users = [];


	$http.get('/WarehouseRoto/getWarehouseJson/')
		.success(function (data) {
			$scope.articles = data;
		});
	

}]);
})();