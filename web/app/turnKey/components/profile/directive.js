turnKeyApp.directive("tkProfile", function profile()
{
  return {
    restrict: "E",
    replace: true,
    transclude: false,

    scope: {
      teamMember: '='
    },

    templateUrl: "/app/turnKey/components/profile/partial.html",

    controller: ['$scope', '$modal', function ($scope, $modal)
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

      /**
       * Display profile description.
       *
       * @param person
       */
      $scope.displayDescription = function (teamMember)
      {
        $scope.modalTitle = teamMember.Name + ' - ' + teamMember.JobTitle;
        $scope.modalBody = teamMember.Description;

        $scope.modal = $modal({
          template: '/app/turnKey/components/genericContent/textModal/partial.html',
          show: true,
          backdrop: 'static',
          animation: 'am-fade',
          scope: $scope
        });
      };
    }]
  };
});
