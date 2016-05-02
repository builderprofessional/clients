(function()
{
  turnKeyApp.directive("tkViewBuildProcess", dashboard);
  function dashboard()
  {
    return {
      restrict: "A",
      scope: {},
      templateUrl: "/app/turnKey/views/process/partial.html",

      controller: ['$scope', 'PropelSOAService',
        function($scope, PropelSOAService)
        {
          $scope.site = {};
          $scope.steps = [];

          var siteQuery = PropelSOAService.getQuery('Clients', 'TurnKey', 'Site');
          siteQuery.isPublic = true;
          siteQuery.addEqualFilter('Code', 'burghli');
          siteQuery.addInnerJoin('BuildProcess');

          siteQuery.runQueryOne($scope, 'site').then(function () {
            $scope.populateScope();
          });


          /**
           * This method will break up retrieved data into objects for the view.
           */
          $scope.populateScope = function ()
          {
            var steps = $scope.site.relations.BuildProcesses.collection;

            for (var stepIndex = 0; stepIndex < steps.length; ++stepIndex)
            {
              var record = steps[stepIndex];

              var step = {
                StepNumber: record.model.SortOrder,
                Description: record.model.Process,
                Image: record.model.Image
              };

              $scope.steps.push(step);
            }
          };
        }
      ]
    };
  }

})();
