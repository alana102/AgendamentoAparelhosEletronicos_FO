<?php
session_start();
include('../DAO/conexao.php');

if(empty($_POST['login']) || empty($_POST['senha'])) {
	header('Location: ../View/indexadmin.php');
	exit();
}

$conexao = mysqli_connect('localhost', 'root', '', 'agendamentofo') or die ('Não foi possível conectar');

$login = mysqli_real_escape_string($conexao, $_POST['login']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

$query = "select usu_login from tab_user where usu_login = '{$login}' and usu_senha = '{$senha}' and usu_nivel=1";
$result = mysqli_query($conexao, $query);
$row = mysqli_num_rows($result);

if($row == 1) {
	$_SESSION['login'] = $login;
	header('Location: ../View/indexadmin.php');
	exit();
} else{
	$_SESSION['nao_autenticado'] = true;
	header('Location: ../View/indexadmin.php');
	exit();
} 
?>

