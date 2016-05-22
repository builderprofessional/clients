// define our angular app that encompasses all of our pages and inject all
// module dependencies
turnKeyApp = angular.module(
  'TurnKeyApp',
  ['engApp', 'engAuth', 'ngAnimate', 'engState', 'mgcrea.ngStrap', 'LocalStorageModule', 'HiggidyCarousel', 'uiGmapgoogle-maps']
);

engApp.constant('APP_CONFIG',{
  App: {
    Name: "BurghliHomes.com"
  }
});
//configure routing defaults
turnKeyApp.config(function ($locationProvider, $urlRouterProvider, $httpProvider, uiGmapGoogleMapApiProvider)
{
    $httpProvider.defaults.headers.common['Cache-Control'] = 'no-cache';
    $urlRouterProvider.otherwise('/dashboard');

    // this will allow us to communicate cross domain
    $httpProvider.defaults.useXDomain = true;
    $locationProvider.html5Mode(false);

  uiGmapGoogleMapApiProvider.configure({
    v: '3.20',
    key: 'AIzaSyClzj6TxW7idUntJGa1S38zNu2768J2MDI',
    libraries: 'geometry, visualization'
  });
});

//configure datepicker defaults
turnKeyApp.config(function($datepickerProvider) {
  angular.extend($datepickerProvider.defaults, {
    dateFormat: 'MM/dd/yyyy',
    startWeek: 1,
    autoclose: true
  });
});


//configure modal/aside defaults
turnKeyApp.config(function($asideProvider){
  angular.extend($asideProvider.defaults,
     {
       template: '/app/engine/engApp/components/elements/aside/eng-aside.html',
       show: true
     }
  );
});

//bootstrap the app when the page is done loading
angular.element(document).ready(function ()
{
    angular.bootstrap(document.body, ['TurnKeyApp']);
});
