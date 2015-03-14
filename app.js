
(function(){
var rideshare=angular.module("rideshare",["ngRoute"]);

rideshare.config(function($routeProvider){
	$routeProvider
	.when('/',{
		controller: 'homeController',
		templateUrl: 'src/partials/homePage.html'
	})
	
	.when('/about',{
		controller: 'aboutController',
		templateUrl: 'src/partials/aboutPage.html'
	})
	.when('/api',{
		controller: 'apiController',
		templateUrl: 'src/partials/apiPage.html'
	})
	.when('/access',{
		controller: 'accessController',
		templateUrl: 'src/partials/accessPage.html'
	})
	

	
	.otherwise({redirectTo:'/'});

});

rideshare.directive("pageHeader", function() {
      return {
        restrict: 'E',
        templateUrl: "src/directives/page-header.html"
      };
    });

rideshare.directive("pageFooter", function() {
      return {
        restrict: 'E',
        templateUrl: "src/directives/page-footer.html"
      };
    });




  })();




