(function()
{
  turnKeyApp.directive("tkViewContact", ['engValidation', '$q', dashboard]);
  function dashboard(engValidation, $q)
  {
    return {
      restrict: "A",
      scope: {},
      templateUrl: "/app/turnKey/views/contact/partial.html",
      controller: ['$scope',
        function($scope)
        {
          var qRules = engValidation.getRuleset('contactus');
          $q.all([qRules]).then(function ()
          {
            $scope.validator = engValidation.getValidator('contactus');
            $scope.validator.watch($scope, $scope.ContactUs);
          });

          $scope.contact = function ()
          {
            alert('trying to contact');
          };
        }
      ]
    };
  }

})();
