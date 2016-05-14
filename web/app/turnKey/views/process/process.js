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
           * This method will figure out what CSS classes the description container should
           * have. This changes based on whether or not an image is present for the step.
           */
          $scope.getDescriptionContainerClass = function (step)
          {
            return step.Image
              ? 'step-description'
              : 'step-description no-image';
          };

          /**
           * This method will break up retrieved data into objects for the view.
           */
          $scope.populateScope = function ()
          {
            var steps = $scope.site.relations.BuildProcesses.collection;

            for (var stepIndex = 0; stepIndex < steps.length; ++stepIndex)
            {
              var record = steps[stepIndex];

              var imageUrl = "";
              if (record.model.Image)
              {
                imageUrl = "/images/burghli/photos/buildProcess/" + record.model.Image;
              }

              var step = {
                Title: record.model.Title,
                StepNumber: record.model.SortOrder,
                Description: record.model.Process,
                Image: imageUrl
              };

              $scope.steps.push(step);
            }
          };
        }
      ]
    };
  }

})();
