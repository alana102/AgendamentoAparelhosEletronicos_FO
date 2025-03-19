<?php

//Includes dos controllers
include_once "CUsuario.php";
include_once "CAgendamento.php";
include_once "CEquipamento.php";
include_once "CCategoria.php";



//Rotas do usuário

//Cadastrar e editar usuário
if(filter_input(INPUT_GET, "acao")=="cadastrar" & filter_input(INPUT_GET, "tipo")==
"usuario") {
    if (filter_input(INPUT_POST, "id") != ""){
        CUsuario::editarUsuario($_POST);
}else {
        CUsuario::cadastrarUsuario($_POST);
}
}

if(filter_input(INPUT_GET, "acao")=="cadastrar" & filter_input(INPUT_GET, "tipo")==
"usuarioprof") {
    if (filter_input(INPUT_POST, "id") != ""){
        CUsuario::editarUsuarioProf($_POST);
}else {
        CUsuario::cadastrarUsuarioProf($_POST);
}
}

//Excluir usuário
if(filter_input(INPUT_GET, "acao")=="excluir" & filter_input(INPUT_GET, "tipo")==
"usuario" & filter_input(INPUT_GET, "codigo")!=0) {
    CUsuario::excluirUsuario(filter_input(INPUT_GET, "codigo"));
}



//Rotas dos agendamentos

//Cadastrar e editar agendamentos
if(filter_input(INPUT_GET, "acao")=="cadastrar" & filter_input(INPUT_GET, "tipo")==
"agendamento") {
    if (filter_input(INPUT_POST, "id") != ""){
        CAgendamento::editarAgendamento($_POST);
}else {
    CAgendamento::cadastrarAgendamento($_POST);
}
}

//Excluir agendamentos da página dos professores
if(filter_input(INPUT_GET, "acao")=="cadastrar" & filter_input(INPUT_GET, "tipo")==
"agendamentoprof") {
    if (filter_input(INPUT_POST, "id") != ""){
        CAgendamento::editarAgendamentoProf($_POST);
}else {
    CAgendamento::cadastrarAgendamentoProf($_POST);
}
}

//Excluir agendamentos gerais
if(filter_input(INPUT_GET, "acao")=="excluir" & filter_input(INPUT_GET, "tipo")==
"agendamento" & filter_input(INPUT_GET, "codigo")!=0) {
    CAgendamento::excluirAgendamento(filter_input(INPUT_GET, "codigo"));
}

//Concluir agendamentos gerais
if(filter_input(INPUT_GET, "acao")=="concluir" & filter_input(INPUT_GET, "tipo")==
"agendamento" & filter_input(INPUT_GET, "codigo")!=0) {
    CAgendamento::concluirAgendamento(filter_input(INPUT_GET, "codigo"));
}

//Concluir agendamentos da página dos professores
if(filter_input(INPUT_GET, "acao")=="concluir" & filter_input(INPUT_GET, "tipo")==
"agendamentoprof" & filter_input(INPUT_GET, "codigo")!=0) {
    CAgendamento::concluirAgendamentoProf(filter_input(INPUT_GET, "codigo"));
}



//Rotas dos equipamentos

//Cadastrar equipamentos
if(filter_input(INPUT_GET, "acao")=="cadastrar" & filter_input(INPUT_GET, "tipo")==
"equipamento") {

    CEquipamento::cadastrarEquipamento($_POST);
}

//Excluir equipamentos
if(filter_input(INPUT_GET, "acao")=="excluir" & filter_input(INPUT_GET, "tipo")==
"equipamento" & filter_input(INPUT_GET, "codigo")!=0) {
    CEquipamento::excluirEquipamento(filter_input(INPUT_GET, "codigo"));
}



//Rotas das categorias

//Cadastrar e editar categorias
if(filter_input(INPUT_GET, "acao")=="cadastrar" & filter_input(INPUT_GET, "tipo")==
"categoria") {
    if (filter_input(INPUT_POST, "id") != ""){
        CCategoria::editarCategoria($_POST);
    }else{
        CCategoria::cadastrarCategoria($_POST);
    }
}

//Excluir categorias
if(filter_input(INPUT_GET, "acao")=="excluir" & filter_input(INPUT_GET, "tipo")==
"categoria" & filter_input(INPUT_GET, "codigo")!=0) {
    CCategoria::excluirCategoria(filter_input(INPUT_GET, "codigo"));
}



?>


