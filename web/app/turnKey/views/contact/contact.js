(function()
{
  turnKeyApp.directive("tkViewContact", ['engValidation', '$q', dashboard]);
  function dashboard(engValidation, $q)
  {
    return {
      restrict: "A",
      scope: {},
      templateUrl: "/app/turnKey/views/contact/partial.html",
      controller: ['$scope', 'PropelSOAService',
        function($scope, PropelSOAService)
        {
          $scope.site = {};
          $scope.company = [];
          $scope.address = {};
          $scope.phoneNumbers = {};

          engValidation.setValidationWatch($scope, 'contactus', 'ContactUs');


          var siteQuery = PropelSOAService.getQuery('Clients', 'TurnKey', 'Site');
          siteQuery.isPublic = true;
          siteQuery.addEqualFilter('Code', 'burghli');

          siteQuery.addInnerJoin('Client->Company->Address');
          siteQuery.addInnerJoin('Client->Company->Phone->PhoneType');

          siteQuery.runQueryOne($scope, 'site').then(function () {
            $scope.populateScope();
          });


          /**
           * This method will break up retrieved data into more manageable objects to
           * make work in the template simpler.
           */
          $scope.populateScope = function ()
          {
            var client = $scope.site.relations.Client;

            $scope.company = client.relations.Company;
            $scope.address = $scope.company.relations.Address;

            var phones = $scope.company.relations.Phones.collection;
            for (var phoneIndex = 0; phoneIndex < phones.length; ++phoneIndex)
            {
              var phone = phones[phoneIndex];

              var phoneType = phone.relations.PhoneType;
              var phoneDisplay = phone.model.Number + " (" + phoneType.model.Name + ")";

              $scope.phoneNumbers[phoneType.model.Name] = phone.model.Number;
            }
          };




          $scope.contact = function ()
          {
            console.log($scope.site);
            alert('trying to contact');
          };
        }
      ]
    };
  }

})();
