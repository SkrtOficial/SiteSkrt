<?php

namespace System\Enum;

/**
 * Enum usado para todas as classes de Log
 *
 * @author Leonardo Rocha Castellano <leonardo-r-castellano@outlook.com>
 * @category Enum
 * @package System
 */
class Log {

    const __default = self::Erro;
    const Erro = 1;
    const Alerta = 2;
    const Aviso = 3;
    const Debug = 4;

}
