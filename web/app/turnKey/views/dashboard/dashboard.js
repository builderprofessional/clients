(function()
{
  turnKeyApp.directive("engViewDashboard", dashboard);
		function dashboard()
		{
			return {
				restrict: "A",
				scope: {},
				templateUrl: "/app/turnKey/views/dashboard/partial.html",
				controller: ['$scope',
					function($scope)
					{
						angular.noop();
					}
				]
			};
		}
	   
})();
