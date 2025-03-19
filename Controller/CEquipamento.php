<?php
include "../Model/MEquipamento.php";
include "../DAO/DEquipamento.php";

class CEquipamento{

    public static function cadastrarEquipamento($dadosEquipamento){
        $Equipamento = new MEquipamento($dadosEquipamento['id'], $dadosEquipamento['categoria'], $dadosEquipamento['equipamento'], $dadosEquipamento['obs']);
        DEquipamento::cadastrarEquipamento($Equipamento->getTipoId(), $Equipamento->getNome(), $Equipamento->getObs());
    }

    public static function retornarEquipamento(){
        $Equipamento = DEquipamento::carregarEquipamento();
        return $Equipamento;
    }

    public static function excluirEquipamento($codigo){
        DEquipamento::excluirEquipamento($codigo);
    }


}



?>