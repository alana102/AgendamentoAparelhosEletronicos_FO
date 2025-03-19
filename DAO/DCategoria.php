<?php

class DCategoria {
    public static function cadastrarCategoria($nome) {
        require_once "conexao.php";
        $conexaoBD = Conexao::criarInstancia();

        $sql = "INSERT INTO tab_equitipo(tipo_id, tipo_nome) 
        VALUES (NULL, ?);";

        $stmt = $conexaoBD->prepare ($sql);

        try {
            $stmt->execute(array($nome));
            echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Categoria cadastrado com sucesso')
            window.location.href='../View/cadastroequipamento.php';
            </SCRIPT>");
        } catch (Exception $ex) {
            echo $ex;
            return 0;

        }

    }

    public static function carregarCategoria(){
        require_once "conexao.php";
        $conexaoBD = Conexao::criarInstancia();

        $sql = "SELECT * FROM tab_equitipo;";

        try {
            $stmt = $conexaoBD->query($sql);
            return $stmt->fetchAll();
        } catch (Exception $ex) {
            echo $ex;
            return 0;
        }
    }

    public static function excluirCategoria($codigo){
        require_once "conexao.php";
        $conexaoBD = Conexao::criarInstancia();

        $sql = "DELETE FROM tab_equitipo where tipo_id=?";

       $stmt = $conexaoBD->prepare ($sql);

        try {
            $stmt->execute(array($codigo));
            header("location: ../View/cadastroequipamento.php");
        } catch (Exception $ex) {
            
            echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Impossível excluir, pois esta categoria possui equipamentos cadastrados. Tente novamente mais tarde.')
            window.location.href='../View/cadastrocategoria.php';
            </SCRIPT>");

            return 0;
        }
    }

    public static function editarCategoria($codigo, $nome){
        require_once "conexao.php";
        $conexaoBD = Conexao::criarInstancia();

        $sql = "UPDATE tab_equitipo set tipo_nome=? where tipo_id=?";

       $stmt = $conexaoBD->prepare ($sql);

        try {
            $stmt->execute(array($nome, $codigo));
            header("location: ../View/cadastroequipamento.php");
        } catch (Exception $ex) {
            echo $ex;
            return 0;
        }
    }
}



?>