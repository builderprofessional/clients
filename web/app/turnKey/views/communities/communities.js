(function()
{
  turnKeyApp.directive("tkViewCommunities", dashboard);
  function dashboard()
  {
    return {
      restrict: "A",
      scope: {},
      templateUrl: "/app/turnKey/views/communities/partial.html",
      controller: ['$scope', 'PropelSOAService',
        function($scope, PropelSOAService)
        {
          $scope.site = {};
          $scope.communities = [];


          var siteQuery = PropelSOAService.getQuery('Clients', 'TurnKey', 'Site');
          siteQuery.isPublic = true;
          siteQuery.addEqualFilter('Code', 'burghli');
          siteQuery.addInnerJoin('Community');

          siteQuery.runQueryOne($scope, 'site').then(function () {
            $scope.populateScope();
          });


          /**
           * This method will break up retrieved data into objects for the view.
           */
          $scope.populateScope = function ()
          {
            var communityList = $scope.site.relations.Communities.collection;
            var marker = 'A';

            for (var communityIndex = 0; communityIndex < communityList.length; ++communityIndex)
            {
              var community = communityList[communityIndex];
              var communityDisplayData = {
                Name: community.model.Name,
                Latitude: community.model.Latitude,
                Longitude: community.model.Longitude,
                Marker: marker,
                SortOrder: community.model.SortOrder
              };

              $scope.communities.push(communityDisplayData);
              $scope.communities.sortByProperty('SortOrder');

              marker = String.fromCharCode(marker.charCodeAt(0) + 1);
            }
          };
        }
      ]
    };
  }

})();
