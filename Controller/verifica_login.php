<?php

//Inicia a session
session_start();

//Verifica se não existe a variável de login
if(!$_SESSION['login']) {

	//Caso não exista, redireciona para a página de login do admin novamente
	header('Location: ../View/loginnovo.php');
	exit();
}

?>