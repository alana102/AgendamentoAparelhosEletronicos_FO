<?php

class Conexao {
    private static $instancia = NULL;

    public static function criarInstancia(){
        if (!isset(self::$instancia)){
            $optionsPDO[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            self::$instancia = new PDO('mysql:host=localhost;dbname=agendamentofo;
            charset=utf8', 'root', '', $optionsPDO);
        }
        return self::$instancia;
    }
}

?>