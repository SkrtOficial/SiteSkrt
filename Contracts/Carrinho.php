<?php

namespace ContractModel;

/**
 * Primeira camada da classe Funcionário
 *
 * @author Leonardo Rocha Castellano <leonardo-r-castellano@outlook.com>
 * @category Facade
 * @package Skrt
 */
class Carrinho {

    // <editor-fold defaultstate="collapsed" desc="Properties">
    private $IdCliente;
    private $IdProduto;
    private $Qtd;

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="Getters and Setters">
    // <editor-fold defaultstate="collapsed" desc="Getters">
    public function getIdCliente(): int {
        return $this->IdCliente;
    }

    public function getIdProduto(): int {
        return $this->IdProduto;
    }

    public function getQtd(): int {
        return $this->Qtd;
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="Setters">
    public function setIdCliente(int $IdCliente) {
        $this->IdCliente = $IdCliente;
    }

    public function setIdProduto(int $IdProduto) {
        $this->IdProduto = $IdProduto;
    }

    public function setQtd(int $Qtd) {
        if ($Qtd < 0)
            $Qtd = 0;

        $this->Qtd = $Qtd;
    }

// </editor-fold>
    // </editor-fold>
}
