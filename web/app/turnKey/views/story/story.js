(function()
{
  turnKeyApp.config(['engStateProvider', function (state)
  {
    state.add({view: null, name: "aboutus", title: "About Us", url: null, role: 'ROLE_ALL', menus: {'main': 2}});
    state.add({view: 'engViewStory', title: "Our Story", url: '/story', role: 'ROLE_ALL', parent: 'aboutus', menus: {'main': 2}});
  }]);

  turnKeyApp.directive("engViewStory", dashboard);
  function dashboard()
  {
    return {
      restrict: "A",
      scope: {},
      templateUrl: "/app/turnKey/views/story/partial.html",
      controller: ['$scope',
        function($scope)
        {
          angular.noop();
        }
      ]
    };
  }

})();
