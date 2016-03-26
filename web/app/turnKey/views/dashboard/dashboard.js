(function()
{
  turnKeyApp.config(['engStateProvider', function (state)
  {
    state.add({view: 'engViewDashboard', title: "Home", url: '/dashboard', role: 'ROLE_ALL', menus: {'main': 1}});
  }]);

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
