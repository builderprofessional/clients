(function()
{
  turnKeyApp.directive("tkViewGallery", viewGallery);
  function viewGallery()
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
