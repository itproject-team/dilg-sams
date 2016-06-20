var base_url = $('#base_url').val();
angular.module('myApp', []).controller('myCtrl', ['$scope', '$compile', '$http', function($scope, $compile, $http){
		var today = new Date();
		$scope.date_today = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
		initTables($scope, $compile);
	}])