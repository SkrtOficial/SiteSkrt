<?php

namespace Facade;

/**
 * Primeira camada da classe Carrinho
 *
 * @author Leonardo Rocha Castellano <leonardo-r-castellano@outlook.com>
 * @category Facade
 * @package Skrt
 */
class Carrinho {

    // <editor-fold defaultstate="collapsed" desc="Properties">
    use \System\Traits\LogTrait;

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="Inserir">
    public function Inserir(\ContractModel\Carrinho $carrinhoContract): bool {
        /**
          Inserir no carrinho.

          Este método insere um produto no carrinho do cliente
          @return bool
         */
        $carrinhoValidator = new \Validator\Carrinho();
        if (!$carrinhoValidator->ValidarInserir($carrinhoContract))
            throw new Exception($carrinhoValidator->GetErrors());

        try {
            $carrinhoBus = new \Business\Carrinho();
            $carrinhoBus->setUsuario($login);
            $carrinhoBus->setSenha($senha);
            return $loginBus->Logar(new \Repository\Carrinho());
        } catch (\Exception $e) {
            $this->log("CarrinhoFacade->Logar()", "Ocorreu um erro ao inserir item no carrinho. "
                    . "Retorno de erro: " . $e->getMessage(), \System\Enum\Log::Erro);
        }
    }

// </editor-fold>
}
