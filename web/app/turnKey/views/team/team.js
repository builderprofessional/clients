(function()
{
  turnKeyApp.directive("tkViewTeam", ['$modal', dashboard]);
  function dashboard($modal)
  {
    return {
      restrict: "A",
      scope: {},
      templateUrl: "/app/turnKey/views/team/partial.html",
      controller: ['$scope', '$http', 'PropelSOAService',
        function($scope, $http, PropelSOAService) {
          $scope.site = {};
          $scope.team = [];


          var siteQuery = PropelSOAService.getQuery('Clients', 'TurnKey', 'Site');
          siteQuery.isPublic = true;
          siteQuery.addEqualFilter('Code', 'burghli');
          siteQuery.addInnerJoin('TeamMember->Employee->Person');

          siteQuery.runQueryOne($scope, 'site').then(function () {
            $scope.populateScope();
          });


          /**
           * This method will break up retrieved data into objects for the view.
           */
          $scope.populateScope = function ()
          {
            var teamMembers = $scope.site.relations.TeamMembers.collection;

            for (var teamMemberIndex = 0; teamMemberIndex < teamMembers.length; ++teamMemberIndex)
            {
              var teamMember = teamMembers[teamMemberIndex];

              var employee = teamMember.relations.Employee;
              var person = employee.relations.Person;

              var memberDisplayData = {
                Name: person.model.FirstName + " " + person.model.LastName,
                JobTitle: employee.model.JobTitle,
                Description: teamMember.model.Description,
                Photo: teamMember.model.ImageFileName,
                SortOrder: teamMember.model.SortOrder
              };

              $scope.team.push(memberDisplayData);
              $scope.team.sortByProperty('SortOrder');
            }
          };

        }
      ]
    };
  }

})();
