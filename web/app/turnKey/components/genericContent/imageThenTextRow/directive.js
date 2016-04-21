turnKeyApp.directive("tkImageThenTextRow", function imageThenTextRow()
{
  return {
    restrict: "E",
    replace: true,
    transclude: true,

    scope: {
      imageSrc: '@'
    },

    templateUrl: "/app/turnKey/components/genericContent/imageThenTextRow/partial.html",

    controller: ['$scope', function ($scope)
    {
      angular.noop();
    }]
  };
});
