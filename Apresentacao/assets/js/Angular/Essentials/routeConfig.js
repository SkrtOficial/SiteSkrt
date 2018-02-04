angular.module("skrt").config(function ($routeProvider) {
    $routeProvider
            .when("/", {
                templateUrl: "includes/public/home.html"
            })
            .when("/login", {
                templateUrl: "includes/public/login.html",
                controller: "loginCtrl"
            })
            .when("/products", {
                templateUrl: "includes/public/products.html",
                controller: "productCtrl"
            })
});

angular.module("skrt").config(['$locationProvider', function ($locationProvider) {
        $locationProvider.hashPrefix('');
    }]);

