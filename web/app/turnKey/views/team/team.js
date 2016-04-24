(function()
{
  turnKeyApp.directive("tkViewTeam", ['$modal', dashboard]);
  function dashboard($modal)
  {
    return {
      restrict: "A",
      scope: {},
      templateUrl: "/app/turnKey/views/team/partial.html",
      controller: ['$scope', '$http',
        function($scope, $http) {
          $scope.team = [];


          /**
           * Download the list of team members.
           */
          $http.get(env_url + '/public/turnkey/team').success(function (result) {
            $scope.team = result.Data;
          });
        }
      ]
    };
  }

})();
