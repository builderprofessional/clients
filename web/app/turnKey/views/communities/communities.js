(function()
{
  turnKeyApp.directive("tkViewCommunities", dashboard);
  function dashboard()
  {
    return {
      restrict: "A",
      scope: {},
      templateUrl: "/app/turnKey/views/communities/partial.html",
      controller: ['$scope', 'PropelSOAService', '$rootScope', 'uiGmapGoogleMapApi', 'uiGmapIsReady',
        function($scope, PropelSOAService, $rootScope, uiGmapGoogleMapApi, uiGmapIsReady)
        {
          $scope.site = {};
          $scope.communities = [];

          $rootScope.mapBuilt = false;


          var siteQuery = PropelSOAService.getQuery('Clients', 'TurnKey', 'Site');
          siteQuery.isPublic = true;
          siteQuery.addEqualFilter('Code', 'burghli');
          siteQuery.addInnerJoin('Community');

          siteQuery.runQueryOne($scope, 'site').then(function () {
            uiGmapIsReady.promise().then(function () {
              $scope.populateScope();
            });
          });

          $scope.map = {
            center: {latitude: 29.60928222414313, longitude: -95.15533447265625},
            zoom: 9,
            options: {
              streetViewControl: false
            }
          };

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
                id: community.model.CommunityId,
                CommunityId: community.model.CommunityId,
                Name: community.model.Name,
                Coordinates: {
                  latitude: parseFloat(community.model.Latitude),
                  longitude: parseFloat(community.model.Longitude)
                },
                MarkerOptions: {
                  label: marker,
                  title: community.model.Name
                },
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
