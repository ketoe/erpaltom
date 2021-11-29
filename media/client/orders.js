(function () {
angular.module('altomApp', [])

.controller('OrdersListCtrl', ['$scope','$http', function ($scope, $http) {


	$scope.orders = [];
	$scope.orderByColumn = 'id';
	$scope.orderByDir = true;
	$scope.filterBy = {};
	$scope.users = [];

	$('.selectYear').change(function () {
		$('#actual_year').html($(this).val());
		$http.get('/Orders/getOrdersJson/'+Number($('#actual_year').html()))
			.success(function (data) {
				$scope.orders = data;
			});
	});



	$http.get('/Orders/getOrdersJson/'+Number($('#actual_year').html()))
			.success(function (data) {
				$scope.orders = data;
			});

		$scope.changeOrder = function (columnName) {
		if ($scope.orderByColumn == columnName) {
			$scope.orderByDir = !$scope.orderByDir;
		}else {
			$scope.orderByColumn = columnName;
			$scope.orderByDir = false;
		}
	}


	$http.get('/Users/getUsersJson')
			.success(function (data) {
				$scope.users = data;
	});

	

}]);
})();