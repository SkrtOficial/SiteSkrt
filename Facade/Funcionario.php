<?php

namespace Facade;

/**
 * Primeira camada da classe Funcionário
 *
 * @author Leonardo Rocha Castellano <leonardo-r-castellano@outlook.com>
 * @category Facade
 * @package Skrt
 */
class FuncionarioFacade {

    // <editor-fold defaultstate="collapsed" desc="Properties">
    use \System\Traits\LogTrait;

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="Logar">
    public function Logar(string $email, string $senha): int {
        /**
          Logar com o funcionário.

          Este método faz login com os dados do funcionário
          @return int
         */
        try {
            $loginBus = new \Business\LoginBusiness();
            $loginBus->setUsuario($login);
            $loginBus->setSenha($senha);
            return $loginBus->Logar(new \Repository\FuncionarioRepository());
        } catch (\Exception $e) {
            $this->log("FuncionarioFacade->Logar()", "Ocorreu um erro ao logar com o funcionário. "
                    . "Retorno de erro: " . $e->getMessage(), \System\Enum\Log::Erro);
        }
    }

// </editor-fold>
}
