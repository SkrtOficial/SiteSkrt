<?php

$app->post('/carrinho/adicionar', function() {
    $facadeContract = new \ContractModel\CarrinhoContractModel();
    $facadeContract->setIdCliente(1);
    $facadeContract->setIdProduto(1);
    $facadeContract->setQtd(1);
    echo json_encode((new \Facade\CarrinhoFacade())->Inserir($facadeContract));
});
