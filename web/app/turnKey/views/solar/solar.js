(function()
{
  turnKeyApp.directive("tkViewSolar", dashboard);
  function dashboard()
  {
    return {
      restrict: "A",
      scope: {},
      templateUrl: "/app/turnKey/views/solar/partial.html",
      controller: ['$scope',
        function($scope)
        {
          angular.noop();
        }
      ]
    };
  }

})();
