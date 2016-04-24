turnKeyApp.directive("tkProfile", function profile()
{
  return {
    restrict: "E",
    replace: true,
    transclude: false,

    scope: {
      person: '='
    },

    templateUrl: "/app/turnKey/components/profile/partial.html",

    controller: ['$scope', function ($scope)
    {
      /**
       * This method will get the URL for the profile pic for each profile.
       *
       * @param string photo
       * @return string
       */
      $scope.getImageUrl = function (photo)
      {
        return '/images/burghli/photos/profile/' + photo;
      };
    }]
  };
});
