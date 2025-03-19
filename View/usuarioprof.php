<?php
include('../Controller/verifica_loginprof.php');
include "../DAO/conn.php";
include "../Controller/CUsuario.php";
$listaAdmin = CUsuario::retornarAdmin();
$listaProfessor = CUsuario::retornarProfessor();


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuário</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">


    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dashboard2.css">
    <link rel="icon" type="image/png" href="Assets/IMG/usuarios.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.14/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,800&display=swap">
    <link rel="stylesheet" href="datatable/css/style.css">

    <link rel="stylesheet" href="css/edit_Usu1.css">

</head>

<body>

    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
            </div>
            <div class="p-3">
                <h1><a href="indexadmin.php" class="logo"> <img src="Assets/IMG/logo.png" sizes="10px" id="logo" width="100%"> </a></h1>

                <div class="mb-5" style="text-align: center;">
                    <h3 class="h6 mb-3" style="font-size: 18px; font-weight: 600">Bem-vindo(a),<br> <?php foreach ($listaProfessor as $usuario) {
                        if ($usuario['usu_login']==$_SESSION['loginprof']){

						$nome = $usuario['usu_nome'];
                        $arrayNomes = explode(" ", $nome);
                        $doisPrimeirosNomes = array_slice($arrayNomes, 0, 2);
						echo implode(" ", $doisPrimeirosNomes);

                            // echo $usuario['usu_nome'];

                        }
                    }?>!</h3>
                </div>
                <!--<div style="width: 270px; height: 50px; background: #E2953A;">-->
                <ul class="list-unstyled components mb-3" style="padding-left: 20px">

                    <li>

                        <a href="index.php">
                            <span class="fa fa-home mr-3"></span> Início</a>
                    </li>

                    <li>
                        <a href="agendamentoprofindividual.php"><span class="fa fa-sticky-note mr-3"></span> Agendamentos</a>
                    </li>
                    <li>
                        <a href="equipamentoprof.php"><span class="fa fa-wrench mr-3"></span> Equipamentos</a>
                    </li>
                    <li class="active">
                        <a href="usuarioprof.php"><span class="fa fa-users mr-3"></span> Usuários</a>
                    </li>
                    <li>
                        <a href="https://drive.google.com/file/d/1EPsvnT4qCSxVACktcsHcWNmi7PYygQp0/view?usp=sharing" target="_blank">
                            <span class="fa fa-question mr-3" style="padding-right:9px"></span>
                            Ajuda
                        </a>
                    </li>

                    <li style="text-align: center; margin-top: 35%; font-size: 18px; margin-right: 22px;">
                        <a href="../Controller/logoutprof.php"><span class="fa fa-sign-out mr-3"></span> Sair</a>
                    </li>
                </ul>
            </div>

            <!--</div>-->
        </nav>


        <div id="content" class="p-4 p-md-5 pt-5">
            <div class="container-geral" style="margin:5px">
                <?php
                foreach ($listaProfessor as $usuario) {
                    if ($usuario['usu_login'] == $_SESSION['loginprof']) {

                ?>

                        <div class="container-geral">
                            <div class="container-formulario" style="padding:10px">
                                <div class="container-corpo">
                                    <div class="form-edit-usuario">
                                        <div class="titulo">Aqui estão suas informações pessoais:</div>
                                        <p style="padding-top: 10px;"> Deseja visualizar seus outros colegas?
                                            <a href="profcadastrados.php" style="color: #E2953A; font-weight: 600; text-decoration: none; border: none; background: none; cursor: pointer;">CLIQUE AQUI</a>
                                        </p>
                                        <form method="POST" action="../Controller/rotas.php?acao=cadastrar&tipo=usuarioprof">
                                            <div class="form-corpo">
                                                <div class="campo">
                                                    <span class="campo-titulo">Código</span>
                                                    <input type="text" readonly value="<?php
                                                                                        echo $usuario['usu_id'];
                                                                                        ?>" name="id">
                                                </div>
                                                <div class="campo">
                                                    <span class="campo-titulo">Nome</span>
                                                    <input type="text" required value="<?php
                                                                                        echo $usuario['usu_nome'];
                                                                                        ?>" name="nome" required>
                                                </div>
                                                <div class="campo">
                                                    <span class="campo-titulo">Email</span>
                                                    <input type="text" required value="<?php
                                                                                        echo $usuario['usu_email'];
                                                                                        ?>" name="email">
                                                </div>
                                                <div class="campo">
                                                    <span class="campo-titulo">Login</span>
                                                    <input type="text" required value="<?php
                                                                                        echo $usuario['usu_login'];
                                                                                        ?>" name="login">
                                                </div>
                                                <div class="campo">
                                                    <span class="campo-titulo">Senha</span>
                                                    <input type="password" id="senha" value="<?php
                                                                                                echo $usuario['usu_senha'];
                                                                                                ?>" name="senha">

                                                    <i class="fa fa-eye fa-lg fa-fw  lnr lnr-eye" id="olho" onclick="MostrarSenha()" aria-hidden="true"></i>
                                                </div>
                                                <div class="campo">
                                                    <span class="campo-titulo">Nível</span>
                                                    <input type="text" readonly value="<?php
                                                                                        echo $usuario['usu_nivel'];
                                                                                        ?>" name="nivel">
                                                </div><?php
                                                    }
                                                } ?>
                                            </div>
                                            <div class="button">
                                                <input type="submit" value="Atualizar dados">

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
        </div>


        <script src="js/jquery.min.js"></script>
        <script src="js/popper.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.14/js/jquery.dataTables.min.js"></script>
        <script src="js/datatable_usu.js"></script>
        <script src="js/modal_Usu.js"></script>
        <script src="js/Log_olho.js" defer></script>

</body>

</html>