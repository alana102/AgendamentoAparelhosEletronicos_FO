<?php
include "../Model/MCategoria.php";
include "../DAO/DCategoria.php";

class CCategoria {
    public static function cadastrarCategoria($dadosCategoria){
        $Categoria = new MCategoria($dadosCategoria['id'], $dadosCategoria['nome'] );
        DCategoria::cadastrarCategoria($Categoria->getNome());
    }

    public static function retornarCategoria(){
        $Categoria = DCategoria::carregarCategoria();
        return $Categoria;
    }

    public static function excluirCategoria($codigo){
        DCategoria::excluirCategoria($codigo);
    }

    public static function editarCategoria($dadosCategoria){
        $Categoria = new MCategoria($dadosCategoria['id'], $dadosCategoria['nome']);
        DCategoria::editarCategoria($Categoria->getId(), $Categoria->getNome());
    }
}

?>