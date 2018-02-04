<?php

namespace System\Validator;

/**
 * Classe abstrata responsável por validar dados
 *
 * @author Leonardo Rocha Castellano <leonardo-r-castellano@outlook.com>
 * @category Validator
 * @package System
 */
abstract class Validator {

    private $errors = [];
    private $contract;

    public function Required(Array $camposObrigatorios = []) {
        if (!is_object($contract))
            return new Exception("Use o método SetContract para passar um contrato válido.");

        if (empty($camposObrigatorios)) {
            foreach ($this->contract as $model => $value) {
                if (empty($model))
                    InsertError($model, "Este campo é obrigatório.");
            }
            return;
        }
        foreach ($this->contract as $model => $value) {
            foreach ($camposObrigatorios as $campo) {
                if ($campo == $model && empty($model))
                    InsertError($model, "Este campo é obrigatório.");
            }
        }
    }

    public function Min(Array $camposMinimo = []) {
        if (!is_object($contract))
            return new Exception("Use o método SetContract para passar um contrato válido.");

        foreach ($this->contract as $model => $value) {
            foreach ($camposMinimo as $campo) {
                if ($campo == $model && strlen($model) < $value)
                    if (is_numeric($value))
                        InsertError($model, "Valor deve ser maior que " . $value);
                    else
                        InsertError($model, "Campo deve ter no mínimo " . $value . " caracteres.");
            }
        }
    }

    public function Max(Array $camposMaximo = []) {
        if (!is_object($contract))
            return new Exception("Use o método SetContract para passar um contrato válido.");

        foreach ($this->contract as $model => $value) {
            foreach ($camposMaximo as $campo) {
                if ($campo == $model && strlen($model) > $value)
                    if (is_numeric($value))
                        InsertError($model, "Valor deve ser menor que " . $value);
                    else
                        InsertError($model, "Campo deve ter no máximo " . $value . " caracteres.");
            }
        }
    }

    public function Mail(Array $fields) {
        if (!is_object($contract))
            return new Exception("Use o método SetContract para passar um contrato válido.");

        foreach ($this->contract as $model => $value)
            foreach ($fields as $field => $mail) {
                if ($field == $model) {
                    if (!filter_var($mail, FILTER_VALIDATE_EMAIL))
                        InsertError($field, "E-mail inválido.");

                    $dominio = explode('@', $mail);
                    if (!checkdnsrr($dominio[1], 'A'))
                        InsertError($field, "E-mail inválido.");
                }
            }
    }

    public function Cpf(Array $fields) {
        if (!is_object($contract))
            return new Exception("Use o método SetContract para passar um contrato válido.");

        foreach ($this->contract as $model => $value)
            foreach ($fields as $field) {
                if ($field == $model) {
                    $cpf = preg_replace('/[^0-9]/', '', (string) $value);
                    // Valida tamanho
                    if (strlen($cpf) != 11)
                        InsertError($field, "CPF inválido.");
                    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
                    if (preg_match('/(\d)\1{10}/', $cpf))
                        InsertError($field, "CPF inválido.");
                    // Calcula e confere primeiro dígito verificador
                    for ($i = 0, $j = 10, $soma = 0; $i < 9; $i++, $j--)
                        $soma += $cpf{$i} * $j;
                    $resto = $soma % 11;
                    if ($cpf{9} != ($resto < 2 ? 0 : 11 - $resto))
                        InsertError($field, "CPF inválido.");
                    // Calcula e confere segundo dígito verificador
                    for ($i = 0, $j = 11, $soma = 0; $i < 10; $i++, $j--)
                        $soma += $cpf{$i} * $j;
                    $resto = $soma % 11;
                    if ($cpf{10} != ($resto < 2 ? 0 : 11 - $resto))
                        InsertError($field, "CPF inválido.");
                }
            }
    }

    public function Cnpj(Array $fields) {
        if (!is_object($contract))
            return new Exception("Use o método SetContract para passar um contrato válido.");

        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
        // Valida tamanho
        if (strlen($cnpj) != 14)
            InsertError($field, "CNPJ inválido.");

        if (preg_match('/(\d)\1{13}/', $cpf))
            InsertError($field, "CNPJ inválido.");
        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        if ($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto))
            InsertError($field, "CNPJ inválido.");
        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        if ($cnpj{13} != ($resto < 2 ? 0 : 11 - $resto))
            InsertError($field, "CNPJ inválido.");
    }

    public function HasErrors() {
        return !empty($this->errors);
    }

    public function GetErrors() {
        return $this->errors;
    }

    public function SetContract(object $contract) {
        $this->contract = $contract;
    }

    private function InsertError($field, $message) {
        $this->errors[$field][] = $message;
    }

}
