(function()
{
  turnKeyApp.directive("tkViewTestimonials", dashboard);
  function dashboard()
  {
    return {
      restrict: "A",
      scope: {},
      templateUrl: "/app/turnKey/views/testimonials/partial.html",
      controller: ['$scope', '$http', 'PropelSOAService',
        function($scope, $http, PropelSOAService)
        {
          $scope.site = {};
          $scope.testimonials = [];


          var siteQuery = PropelSOAService.getQuery('Clients', 'TurnKey', 'Site');
          siteQuery.isPublic = true;
          siteQuery.addEqualFilter('Code', 'burghli');
          siteQuery.addInnerJoin('Testimonial');

          siteQuery.runQueryOne($scope, 'site').then(function () {
            $scope.populateScope();
          });


          /**
           * This method will determine what classes should be added to the testimonials
           * details section. This will be different based on whether or not there
           * is an image to display.
           *
           * @param testimonial
           */
          $scope.getDetailsContainerClass = function (testimonial)
          {
            return testimonial.Image
              ? 'testimonial-details'
              : 'testimonial-details no-image';
          };

          /**
           * This method will break up retrieved data into objects for the view.
           */
          $scope.populateScope = function ()
          {
            var list = $scope.site.relations.Testimonials.collection;

            for (var testimonialIndex = 0; testimonialIndex < list.length; ++testimonialIndex)
            {
              var testimonial = list[testimonialIndex];
              var testimonialDisplayData = testimonial.model;

              $scope.testimonials.push(testimonialDisplayData);
              $scope.testimonials.sortByProperty('SortOrder');
            }
          };
        }
      ]
    };
  }
})();
