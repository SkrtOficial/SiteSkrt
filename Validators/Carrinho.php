<?php

namespace Validator;

use System\Validator\Validator;

/**
 * Classe responsável por validar dados da Facade Carrinho
 *
 * @author Leonardo Rocha Castellano <leonardo-r-castellano@outlook.com>
 * @category Validator
 * @package Skrt
 */
class Carrinho extends Validator {

    public function ValidarInserir(\ContractModel\Carrinho $contract): bool {
        $this->SetContract($contract);
        $this->Required();
        if (!$this->HasErrors())
            return false;
        return true;
    }

}
