(function()
{
  turnKeyApp.directive("tkViewFAQ", dashboard);
  function dashboard()
  {
    return {
      restrict: "A",
      scope: {},
      templateUrl: "/app/turnKey/views/faq/partial.html",
      controller: ['$scope', 'PropelSOAService',
        function($scope, PropelSOAService)
        {
          $scope.site = {};
          $scope.questions = [];
          $scope.expandedQuestions = [];

          var siteQuery = PropelSOAService.getQuery('Clients', 'TurnKey', 'Site');
          siteQuery.isPublic = true;
          siteQuery.addEqualFilter('Code', 'burghli');
          siteQuery.addInnerJoin('Faq');

          siteQuery.runQueryOne($scope, 'site').then(function () {
            $scope.populateScope();
          });


          /**
           * This method will break up retrieved data into objects for the view.
           */
          $scope.populateScope = function ()
          {
            var faqs = $scope.site.relations.Faqs.collection;

            for (var faqIndex = 0; faqIndex < faqs.length; ++faqIndex)
            {
              var faq = faqs[faqIndex];

              var question = {
                Question: faq.model.Question,
                Answer: faq.model.Answer,
                SortOrder: faq.model.SortOrder,
                Expanded: false
              };

              $scope.questions.push(question);
            }
          };

          $scope.toggle = function (faq)
          {
            faq.Expanded = !faq.Expanded;
          };

        }
      ]
    };
  }

})();
