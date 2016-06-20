var base_url = $('#base_url').val(); 
angular.module('myApp', [])
	.directive('format', ['$filter', function ($filter) {
	    return {
	        require: '?ngModel',
	        link: function (scope, elem, attrs, ctrl) {
	            if (!ctrl) return;


	            ctrl.$formatters.unshift(function (a) {
	                return $filter(attrs.format)(ctrl.$modelValue)
	            });


	            ctrl.$parsers.unshift(function (viewValue) {
	                var plainNumber = viewValue.replace(/[^\d|\-+|\.+]/g, '');
	                elem.val($filter(attrs.format)(plainNumber));
	                return plainNumber;
	            });
	        }
	    };
	}])

	// .directive('inventoryItem', function($compile){
	// 		return{
	// 			restrict: 'A',
	// 			controller: function($scope, $http){
	// 				$scope.initInventory = function(){
	// 					$scope.view_pc_list = [];
	// 					$scope.update_pc_list = [];
						
	// 					$http.get(base_url+"/gss/head/pc/pc_list").success(function(response){
	// 						$.each(response, function(index, value){
	// 								$scope.view_pc_list.push(value);
	// 								console.log(value);
								
	// 						});
	// 					});
	// 				}
	// 			},

	// 			link: function(scope, element, attrs){
	// 				scope.initInventory();
	// 				element.append($compile(
	// 					"<tr ng-repeat='item in view_pc_list track by $index'>"+
	// 						"<td>{{ item.date_created }}</td>"+
	// 						"<td>{{ item.employee }}</td>"+
	// 						"<td>{{ item.status }}</td>"+
	// 						"<td>{{ item.remarks }}</td>"+
	// 					"</tr>"
	// 				)(scope));
	// 			}
	// 		}
	// 	})

	.controller('myCtrl', ['$scope', '$compile', '$http', function($scope, $compile, $http){
		$scope.edit_modal_current_items = [];

		$scope.pc_list = [];
		$scope.selected_pc_items = [];

		$scope.view_pc_list = [];
		$scope.update_pc_list = [];

		$http.get(base_url+"/gss/head/pc/pc_list").success(function(response){
			$.each(response, function(index, value){
					$scope.view_pc_list.push(value);
					console.log(value);
				
			});
		});

	    var today = new Date();
	    $scope.date_today = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
	    $scope.pc_date_today = today.getDate()+''+(today.getMonth()+1)+''+today.getFullYear();
	    $scope.last_pc_id = 1;
	    $scope.last_pc = {id: "1", date_created: "null", date_modified: "null", pc_no: "null", status: "null"};
	    $http.get(base_url+"/gss/head/pc/last_pc").success(function(response){
	    	if(response.length > 0){
	    		$scope.last_pc = response[0];
	    		$scope.last_pc_id = parseFloat(response[0].id) + 1;
	    	}
	    });	

	    initTables($scope);
	}])
