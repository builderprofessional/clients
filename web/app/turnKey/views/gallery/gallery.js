(function()
{
  turnKeyApp.directive("tkViewGallery", dashboard);
  function dashboard()
  {
    return {
      restrict: "A",
      scope: {},
      templateUrl: "/app/turnKey/views/gallery/partial.html",
      controller: ['$scope',
        function($scope)
        {
          angular.noop();
        }
      ]
    };
  }

})();
