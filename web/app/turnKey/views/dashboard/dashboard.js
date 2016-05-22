(function()
{
  turnKeyApp.directive("engViewDashboard", dashboard);
		function dashboard()
		{
			return {
				restrict: "A",
				scope: {},
				templateUrl: "/app/turnKey/views/dashboard/partial.html",
				controller: ['$scope',
					function($scope)
					{
						$scope.images = [];

            for (var imageIndex = 1; imageIndex <=7; ++imageIndex)
            {
              var image = {
                src: "/images/burghli/photos/slider/slider" + imageIndex + ".jpg",
                alt: ""
              };

              $scope.images.push(image);
            }
					}
				]
			};
		}
	   
})();
