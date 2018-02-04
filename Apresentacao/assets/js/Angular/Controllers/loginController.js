angular.module("skrt").controller("loginCtrl", function ($scope, skrtService) {

    $scope.logar = function (dados) {
        skrtService.Logar(dados);
    }
});