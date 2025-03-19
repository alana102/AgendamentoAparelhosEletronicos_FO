<?php

//Inicia a session
session_start();

//Inclui a conexão com o banco
include('../DAO/conexao.php');

//Verifica se existe algo nas variáveis loginprof ou senhaprof
if(empty($_POST['loginprof']) || empty($_POST['senhaprof'])) {

	//Se uma delas estiver vazia, redireciona para a página inicial
	header('Location: ../View/index.php');
	exit();
}

//Cria uma variável para armazenar uma conexão com o banco
$conexao = mysqli_connect('localhost', 'root', '', 'agendamentofo') or die ('Não foi possível conectar');

//Cria uma variável de login para armazenar as informações do loginprof
$login = mysqli_real_escape_string($conexao, $_POST['loginprof']);

//Cria uma variável de senha para armazenar as informações da senhaprof
$senha = mysqli_real_escape_string($conexao, $_POST['senhaprof']);

//Cria uma variável para armazenar o script em SQL
$query = "select usu_login from tab_user where usu_login = '{$login}' and usu_senha = '{$senha}' and usu_nivel=2";

//Executa o script SQL
$result = mysqli_query($conexao, $query);

//Pega o número de linhas que foram executadas com o código SQL
$row = mysqli_num_rows($result);

//Verifica a quantidade de linhas
if($row == 1) {
	//Se for 1 linha, redireciona para a página inicial do prof
	$_SESSION['loginprof'] = $login;
	header('Location: ../View/index.php');
	exit();
} else{
	//Se for diferente de 1 linha, cria uma session
	$_SESSION['nao_autenticado'] = true;
	header('Location: ../View/index.php');
	exit();
} 
?>

