<?php
include "../Model/MAgendamento.php";
include "../DAO/DAgendamento.php";

class CAgendamento {

    public static function cadastrarAgendamento($dadosAgendamento){
        $Agendamento = new MAgendamento($dadosAgendamento['id'], $dadosAgendamento['categoria'], $dadosAgendamento['subcategoria'], $dadosAgendamento['professor'], $dadosAgendamento['data'], $dadosAgendamento['inicio'], $dadosAgendamento['fim'], $dadosAgendamento['obs'] );
        DAgendamento::cadastrarAgendamento($Agendamento->getIdTipo(), $Agendamento->getIdEquip(), $Agendamento->getProf(), $Agendamento->getData(), $Agendamento->getIdAulaInicio(), $Agendamento->getIdAulaFim(), $Agendamento->getObs());
    }

    public static function cadastrarAgendamentoProf($dadosAgendamento){
        $Agendamento = new MAgendamento($dadosAgendamento['id'], $dadosAgendamento['categoria'], $dadosAgendamento['subcategoria'], $dadosAgendamento['professor'], $dadosAgendamento['data'], $dadosAgendamento['inicio'], $dadosAgendamento['fim'], $dadosAgendamento['obs']);
        DAgendamento::cadastrarAgendamentoProf($Agendamento->getIdTipo(), $Agendamento->getIdEquip(), $Agendamento->getProf(), $Agendamento->getData(), $Agendamento->getIdAulaInicio(), $Agendamento->getIdAulaFim(), $Agendamento->getObs());
    }

    public static function retornarAgendamento(){
        $Agendamento = DAgendamento::carregarAgendamento();
        return $Agendamento;
    }


    public static function retornarAgendamentoTotal(){
        $Agendamento = DAgendamento::carregarAgendamentoTotal();
        return $Agendamento;
    }

    public static function excluirAgendamento($codigo){
        DAgendamento::excluirAgendamento($codigo);
    }

    public static function editarAgendamento($dadosAgendamento){
        $Agendamento = new MAgendamento($dadosAgendamento['id'], $dadosAgendamento['categoria'], $dadosAgendamento['subcategoria'], $dadosAgendamento['professor'], $dadosAgendamento['data'], $dadosAgendamento['inicio'], $dadosAgendamento['fim'], $dadosAgendamento['obs']);
        DAgendamento::editarAgendamento($Agendamento->getId(), $Agendamento->getIdTipo(), $Agendamento->getIdEquip(), $Agendamento->getProf(), $Agendamento->getData(), $Agendamento->getIdAulaInicio(), $Agendamento->getIdAulaFim(), $Agendamento->getObs());
    }

    public static function editarAgendamentoProf($dadosAgendamento){
        $Agendamento = new MAgendamento($dadosAgendamento['id'], $dadosAgendamento['categoria'], $dadosAgendamento['subcategoria'], $dadosAgendamento['professor'], $dadosAgendamento['data'], $dadosAgendamento['inicio'], $dadosAgendamento['fim'], $dadosAgendamento['obs']);
        DAgendamento::editarAgendamentoProf($Agendamento->getId(), $Agendamento->getIdTipo(), $Agendamento->getIdEquip(), $Agendamento->getProf(), $Agendamento->getData(), $Agendamento->getIdAulaInicio(), $Agendamento->getIdAulaFim(), $Agendamento->getObs());
    }

    public static function concluirAgendamento($codigo){
        DAgendamento::concluirAgendamento($codigo);
    }
    public static function concluirAgendamentoProf($codigo){
        DAgendamento::concluirAgendamentoProf($codigo);
    }
   

   

}

    


?>