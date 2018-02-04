<?php

$app->post('/funcionario/logar', function() {
    $facade = new \Facade\AlunoFacade();
    $retorno = $facade->Listar();
    echo json_encode($retorno);
});
