(function()
{
  turnKeyApp.directive("tkViewStory", dashboard);
  function dashboard()
  {
    return {
      restrict: "A",
      scope: {},
      templateUrl: "/app/turnKey/views/story/partial.html",
      controller: ['$scope',
        function($scope)
        {
          angular.noop();
        }
      ]
    };
  }

})();
