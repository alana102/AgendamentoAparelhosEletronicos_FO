<?php

//Inicia a session
session_start();

//Verifica se não existe a variável loginprof
if(!$_SESSION['loginprof']) {

	//Caso não exista, redireciona para a página de login do prof novamente
	header('Location: ../View/loginnovo.php');
	exit();
}

?>