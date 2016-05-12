(function()
{
  turnKeyApp.directive("tkViewAvailableHomes", dashboard);
  function dashboard()
  {
    return {
      restrict: "A",
      scope: {},

      templateUrl: "/app/turnKey/views/availablehomes/partial.html",

      controller: ['$scope', '$http', 'PropelSOAService',
        function($scope, $http, PropelSOAService)
        {
          $scope.site = {};
          $scope.homes = [];

          var siteQuery = PropelSOAService.getQuery('Clients', 'TurnKey', 'Site');
          siteQuery.isPublic = true;
          siteQuery.addEqualFilter('Code', 'burghli');
          siteQuery.addInnerJoin('AvailableHome->Address');
          //siteQuery.addInnerJoin('AvailableHome->Community');

          siteQuery.runQueryOne($scope, 'site').then(function () {
            $scope.populateScope();
          });


          /**
           * This method will break up retrieved data into objects for the view.
           */
          $scope.populateScope = function ()
          {
            var availableHomes = $scope.site.relations.AvailableHomes.collection;

            for (var homeIndex = 0; homeIndex < availableHomes.length; ++homeIndex)
            {
              var home = availableHomes[homeIndex];
              var address = home.relations.Address;

              var imageUrl = "";
              if (home.model.Image)
              {
                imageUrl = "/images/burghli/photos/availableHomes/" + home.model.Image;
              }

              var homeDisplayData = {
                'Title': address.model.Address,
                'Image': imageUrl
              };

              $scope.homes.push(homeDisplayData);
              $scope.homes.sortByProperty('SortOrder');
            }
          };
        }
      ]
    };
  }
})();
