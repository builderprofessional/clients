/**
 *
 * Created with JetBrains PhpStorm.
 * User: rflach
 * Date: 8/26/13
 * Time: 8:57 PM
 * To change this template use File | Settings | File Templates.
 */
engApp.directive('tkViewNavbar', function () //['PropelSOAService','engDelayedProcess','$rootScope','engState','engAlert','APP_CONFIG', function (PropelSOAService,engDelayedProcess,$rootScope,engState,engAlert,APP_CONFIG)
{
  return {
    restrict: "E",
    scope: {},
    templateUrl: "/app/turnKey/views/navigation/partial.html",

    controller: function ($scope, $http)
    {

    }
  };
});