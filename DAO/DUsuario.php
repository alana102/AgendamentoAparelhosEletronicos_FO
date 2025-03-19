<?php

class DUsuario {

    public static function cadastrarUsuario($nome, $email, $login, $senha, $nivel) {
        require_once "conexao.php";
        $conexaoBD = Conexao::criarInstancia();


        $sql = "INSERT INTO tab_user(usu_id, usu_nome, usu_email, usu_login, usu_senha, usu_nivel) 
        VALUES (NULL, ?, ?, ?, ?, ?);";

        $stmt = $conexaoBD->prepare ($sql);
        

        try {
            $stmt->execute(array($nome, $email, $login, $senha, $nivel));
            echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Usuário cadastrado com sucesso')
            window.location.href='../View/cadastrousuario.php';
            </SCRIPT>");
        } catch (Exception $ex) {
            echo $ex;
            return 0;

        }

    }

    public static function cadastrarUsuarioProf($nome, $email, $login, $senha, $nivel) {
        require_once "conexao.php";
        $conexaoBD = Conexao::criarInstancia();


        $sql = "INSERT INTO tab_user(usu_id, usu_nome, usu_email, usu_login, usu_senha, usu_nivel) 
        VALUES (NULL, ?, ?, ?, ?, ?);";

        $stmt = $conexaoBD->prepare ($sql);
        

        try {
            $stmt->execute(array($nome, $email, $login, $senha, $nivel));
            echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Usuário cadastrado com sucesso')
            window.location.href='../View/cadastrousuario.php';
            </SCRIPT>");
        } catch (Exception $ex) {
            echo $ex;
            return 0;

        }

    }

    public static function carregarAdmin(){
        require_once "conexao.php";
        $conexaoBD = Conexao::criarInstancia();

        $sql = "SELECT * FROM tab_user where usu_nivel=1;";

        try {
            $stmt = $conexaoBD->query($sql);
            return $stmt->fetchAll();
        } catch (Exception $ex) {
            echo $ex;
            return 0;
        }
    }

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

    public static function excluirUsuario($codigo){
        require_once "conexao.php";
        $conexaoBD = Conexao::criarInstancia();

        $sql = "DELETE FROM tab_user where usu_id=?";

       $stmt = $conexaoBD->prepare ($sql);

        try {
            $stmt->execute(array($codigo));
            header("location: ../View/cadastrousuario.php");
        } catch (Exception $ex) {
            
            echo $ex;

            return 0;
        }
    }

   

    public static function editarUsuario($codigo, $nome, $email, $login, $senha, $nivel){
        require_once "conexao.php";
        $conexaoBD = Conexao::criarInstancia();

        $sql = "UPDATE tab_user set usu_nome=?, usu_email=?, usu_login=?, usu_senha=?, usu_nivel=? where usu_id=?";

       $stmt = $conexaoBD->prepare ($sql);

        try {
            $stmt->execute(array($nome, $email, $login, $senha, $nivel, $codigo));
            header("location: ../View/cadastrousuario.php");
        } catch (Exception $ex) {
            echo $ex;
            return 0;
        }
    }

    

    
}






?>