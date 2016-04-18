turnKeyApp.directive("tkGallery", function gallery($q)
{
  return {
    restrict: "E",
    replace: true,
    transclude: false,

    scope: {
      rowCount: '@',
      columnCount: '@',
      key: '@',
      selectedCategory: '@'
    },

    templateUrl: "/app/turnKey/components/gallery/partial.html",

    controller: ['$scope', '$http', '$filter', 'Pagination',
      function ($scope, $http, $filter, Pagination)
    {
      /**
       * Initialize our directive state data
       */
      $scope.galleryImages = [];
      $scope.categories = [];

      $scope.paginationKey = "Gallery_" + $scope.key;
      $scope.galleryPagination = new Pagination($scope.paginationKey);
      $scope.galleryPagination.setPerPageOptions([$scope.rowCount * $scope.columnCount]);
      $scope.galleryPagination.setPerPage($scope.rowCount * $scope.columnCount);


      /**
       * Download the list of images for this gallery from the API
       */
      $http.get(env_url + '/public/turnkey/gallery/' + $scope.key).success(function (result)
      {
        $scope.galleryImages = result.Data.images;

        for (var index = 0; index < $scope.galleryImages.length; ++index)
        {
          var image = $scope.galleryImages[index];
          $scope.categories.pushUnique(image.category);
        }
      });


      /**
       * This method will get the list of images that should be viewed based on the selected category.
       *
       * @return Array
       */
      $scope.getImages = function ()
      {
        var viewableImages = $filter('filter')($scope.galleryImages, $scope.selectedCategory);
        return $filter('paginate')(viewableImages, $scope.galleryPagination);
      };


      /**
       * This method will return the number of images are viewable according to the selected category.
       *
       * @return int
       */
      $scope.getImageCount = function ()
      {
        var viewableImages = $scope.getImages();
        return viewableImages.length;
      };


      /**
       * This method will determine if a particular rowIndex and columnIndex references an image. This will
       * return false when there are not enough images to fill this cell.
       *
       * @param int rowIndex
       * @param int columnIndex
       *
       * @return string
       */
      $scope.isValidImage = function (rowIndex, columnIndex)
      {
        var imageIndex = $scope.getImageIndex(rowIndex, columnIndex);
        return imageIndex < $scope.getImageCount();
      };


      /**
       * This method will get the URL for the gallery image.
       *
       * @param int rowIndex
       * @param int columnIndex
       *
       * @return string
       */
      $scope.getImageUrl = function (rowIndex, columnIndex)
      {
        var imageIndex = $scope.getImageIndex(rowIndex, columnIndex);
        var viewableImages = $scope.getImages();
        var image = viewableImages[imageIndex];

        return "/images/burghli/photos/" + image.fileName;
      };


      /**
       * @param rowIndex
       * @param columnIndex
       *
       * @returns int
       */
      $scope.getImageIndex = function (rowIndex, columnIndex)
      {
        return (rowIndex * $scope.columnCount) + columnIndex;
      };
    }]
  };
});
