<?php
class DUsuarioProfEditar{
public static function editarUsuarioProf($codigo, $nome, $email, $login, $senha, $nivel){
        require_once "conexao.php";
        $conexaoBD = Conexao::criarInstancia();

        $sql = "UPDATE tab_user set usu_nome=?, usu_email=?, usu_login=?, usu_senha=?, usu_nivel=? where usu_id=?";

       $stmt = $conexaoBD->prepare ($sql);

        try {
            $stmt->execute(array($nome, $email, $login, $senha, $nivel, $codigo));
            echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Dados atualizados com sucesso')
            window.location.href='../View/usuarioprof.php';
            </SCRIPT>");
        } catch (Exception $ex) {
            echo $ex;
            return 0;
        }
    }}
    ?>