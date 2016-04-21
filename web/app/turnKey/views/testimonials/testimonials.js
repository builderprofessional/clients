(function()
{
  turnKeyApp.directive("tkViewTestimonials", dashboard);
  function dashboard()
  {
    return {
      restrict: "A",
      scope: {},
      templateUrl: "/app/turnKey/views/testimonials/partial.html",
      controller: ['$scope', '$http', '$sce',
        function($scope, $http, $sce)
        {
          $scope.testimonials = [];

          /**
           * Download the list of testimonials.
           */
          $http.get(env_url + '/public/turnkey/testimonials').success(function (result)
          {
            $scope.testimonials = result.Data;
          });


          /**
           * Translate the file name from the database into a URL.
           *
           * @param string fileName
           * @return string
           */
          $scope.getImageUrl = function (fileName)
          {
            return '/images/burghli/photos/fake/' + fileName;
          };
        }
      ]
    };
  }
})();
