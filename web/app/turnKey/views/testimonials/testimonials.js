(function()
{
  turnKeyApp.directive("tkViewTestimonials", dashboard);
  function dashboard()
  {
    return {
      restrict: "A",
      scope: {},
      templateUrl: "/app/turnKey/views/testimonials/partial.html",
      controller: ['$scope',
        function($scope)
        {
          angular.noop();
        }
      ]
    };
  }

})();
