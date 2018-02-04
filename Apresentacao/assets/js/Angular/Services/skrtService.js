angular.module("skrt").service("skrtService", function ($http) {

    this.Logar = function (dadosLogin) {
        console.log(dadosLogin);
    };
    //Metodo usado para listar o Menu usando Ajax e
    //retornando os dados num array Object
    this.Logar = function () {
        $http({
            method: 'POST',
            url: 'http://localhost/funcionario/logar'
        }).then(function (result) {
            console.log(result);
        });
    };
});