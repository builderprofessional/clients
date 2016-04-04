(function()
{
  turnKeyApp.directive("tkViewAvailableHomes", dashboard);
  function dashboard()
  {
    return {
      restrict: "A",
      scope: {},
      templateUrl: "/app/turnKey/views/availablehomes/partial.html",
      controller: ['$scope',
        function($scope)
        {
          angular.noop();
        }
      ]
    };
  }

})();
