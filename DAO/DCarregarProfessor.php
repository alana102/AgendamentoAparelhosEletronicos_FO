<?php

class DCarregarProfessor{
    
    public static function carregarProfessor(){
        require_once "conexao.php";
        $conexaoBD = Conexao::criarInstancia();

        $sql = "SELECT * FROM tab_user where usu_nivel=2;";

        try {
            $stmt = $conexaoBD->query($sql);
            return $stmt->fetchAll();
        } catch (Exception $ex) {
            echo $ex;
            return 0;
        }
    }
}

    ?>