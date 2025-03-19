<?php

class DEquipamento {
    public static function cadastrarEquipamento($tipoid, $nome, $obs) {
        require_once "conexao.php";
        $conexaoBD = Conexao::criarInstancia();

        $sql = "INSERT INTO tab_equipamento(equ_id, equ_tipoid, equ_nome, equ_obs) 
        VALUES (NULL, ?, ?, ?);";

        $stmt = $conexaoBD->prepare ($sql);

        try {
            $stmt->execute(array($tipoid, $nome, $obs));
            echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Equipamento cadastrado com sucesso')
            window.location.href='../View/cadastroequipamento.php';
            </SCRIPT>");
        } catch (Exception $ex) {
            echo $ex;
            return 0;

        }

    }

    public static function carregarEquipamento(){
        require_once "conexao.php";
        $conexaoBD = Conexao::criarInstancia();

        $sql = "SELECT tab_equipamento.equ_id, tab_equitipo.tipo_nome, tab_equipamento.equ_nome, tab_equipamento.equ_obs FROM tab_equipamento
        join tab_equitipo on tab_equipamento.equ_tipoid=tab_equitipo.tipo_id;";

        try {
            $stmt = $conexaoBD->query($sql);
            return $stmt->fetchAll();
        } catch (Exception $ex) {
            echo $ex;
            return 0;
        }
    }

    public static function excluirEquipamento($codigo){
        require_once "conexao.php";
        $conexaoBD = Conexao::criarInstancia();

        $sql = "DELETE FROM tab_equipamento where equ_id=?";

       $stmt = $conexaoBD->prepare ($sql);

        try {
            $stmt->execute(array($codigo));
            header("location: ../View/cadastroequipamento.php");
            
        } catch (Exception $ex) {
            
           echo $ex; 
           ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Impossível excluir, pois este equipamento está relacionado a um agendamento. 
            Se precisa excluir este equipamento, exclua primeiramente todos os agendamentos com os quais ele se relaciona.')
            window.location.href='../View/cadastroequipamento.php';
            </SCRIPT>"); 

            return 0;
        }
    }

}



?>