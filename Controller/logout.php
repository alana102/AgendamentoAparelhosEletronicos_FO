<?php

//Inicia a session
session_start();

//Destrói a session
session_destroy();

//Redireciona para a página inicial, mas, como a session foi destruída, vai direto para a página de login do admin
header('Location: ../View/indexadmin.php');

//Finaliza
exit();
?>