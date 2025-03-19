<?php
include "../Model/MUsuario.php";
include_once "../DAO/DUsuario.php";
include_once "../DAO/DUsuarioProfEditar.php";
include_once "../DAO/DCarregarProfessor.php";

class CUsuario {

    public static function cadastrarUsuario($dadosUsuario){
        $Usuario = new MUsuario($dadosUsuario['id'], $dadosUsuario['nome'], $dadosUsuario['email'], $dadosUsuario['login'], $dadosUsuario['senha'], $dadosUsuario['nivel']);
        DUsuario::cadastrarUsuario( $Usuario->getNome(), $Usuario->getEmail(), $Usuario->getLogin(), $Usuario->getSenha(), $Usuario->getNivel());
    }

    public static function cadastrarUsuarioProf($dadosUsuario){
        $Usuario = new MUsuario($dadosUsuario['id'], $dadosUsuario['nome'], $dadosUsuario['email'], $dadosUsuario['login'], $dadosUsuario['senha'], $dadosUsuario['nivel']);
        DUsuario::cadastrarUsuarioProf( $Usuario->getNome(), $Usuario->getEmail(), $Usuario->getLogin(), $Usuario->getSenha(), $Usuario->getNivel());
    }

    public static function retornarAdmin(){
        $Usuario = DUsuario::carregarAdmin();
        return $Usuario;
    }

    public static function retornarProfessor(){
        $Usuario = DUsuario::carregarProfessor();
        return $Usuario;
    }

    public static function excluirUsuario($codigo){
        DUsuario::excluirUsuario($codigo);
    }

    public static function editarUsuario($dadosUsuario){
        $Usuario = new MUsuario($dadosUsuario['id'], $dadosUsuario['nome'], $dadosUsuario['email'], $dadosUsuario['login'], $dadosUsuario['senha'], $dadosUsuario['nivel']);
        DUsuario::editarUsuario($Usuario->getId(), $Usuario->getNome(), $Usuario->getEmail(), $Usuario->getLogin(), $Usuario->getSenha(), $Usuario->getNivel());
    }

    public static function editarUsuarioProf($dadosUsuario){
        $Usuario = new MUsuario($dadosUsuario['id'], $dadosUsuario['nome'], $dadosUsuario['email'], $dadosUsuario['login'], $dadosUsuario['senha'], $dadosUsuario['nivel']);
        DUsuarioProfEditar::editarUsuarioProf($Usuario->getId(), $Usuario->getNome(), $Usuario->getEmail(), $Usuario->getLogin(), $Usuario->getSenha(), $Usuario->getNivel());
    }

}


?>