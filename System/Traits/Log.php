<?php

namespace System\Traits;

/**
 * Traits usada para gravar mensagens de log
 *
 * @author Leonardo Rocha Castellano <leonardo-r-castellano@outlook.com>
 * @category Traits
 * @package System
 */
trait LogTrait {

    private function statusLog(): bool {
        $dadosIni = parse_ini_file(ROOT . "config.ini");
        if (isset($dadosIni["habilitarLog"]) && trim(strtolower($dadosIni["habilitarLog"])) == "true") {
            return true;
        } else {
            return false;
        }
    }

    public function log($assunto, $mensagem, $categoria) {
        if (!self::statusLog())
            return;
        $arquivo = "";

        $msgFinal = "Assunto: " . $assunto . PHP_EOL;
        switch ($categoria) {
            case \System\Enum\Log::Erro:
                $arquivo = "erros";
                $msgFinal .= "Erro: " . $mensagem . PHP_EOL . PHP_EOL;
                break;
            case \System\Enum\Log::Alerta:
                $arquivo = "alertas";
                $msgFinal .= "Alerta: " . $mensagem . PHP_EOL . PHP_EOL;
                break;
            case \System\Enum\Log::Aviso:
                $arquivo = "avisos";
                $msgFinal .= "Aviso: " . $mensagem . PHP_EOL . PHP_EOL;
                break;
            case \System\Enum\Log::Debug:
                $arquivo = "debugs";
                $msgFinal .= "Debug: " . $mensagem . PHP_EOL . PHP_EOL;
                break;
            default:
                $arquivo = "outros";
                $msgFinal .= "Mensagem: " . $mensagem . PHP_EOL . PHP_EOL;
                break;
        }
        $msgFinal .= "Data: " . date("d/m/Y h:i:s") . PHP_EOL;
        $msgFinal .= "-----------------------" . PHP_EOL . PHP_EOL;
        if (!is_dir(ROOT . "logs")) {
            mkdir(ROOT . "logs");
        }
        $fp = null;
        try {
            $fp = fopen(ROOT . "logs/" . $arquivo . ".txt", "a");
            fwrite($fp, $msgFinal);
        } finally {
            fclose($fp);
        }
    }

}
