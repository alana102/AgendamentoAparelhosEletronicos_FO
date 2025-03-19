<?php
include('../Controller/verifica_login.php');
include "../DAO/conn.php";
include "../Controller/CUsuario.php";

$listaAdmin = CUsuario::retornarAdmin();
$listaAdmin = CUsuario::retornarAdmin();


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários | Administradores</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="icon" type="image/png" href="Assets/IMG/usuarios.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.14/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,800&display=swap">
    <link rel="stylesheet" href="datatable/css/style2.css">
    


    <link rel="stylesheet" href="css/cad_Usu2.css">
    <link rel="stylesheet" href="css/modal_Usu2.css">
    <link rel="stylesheet" href="css/teste.css">
</head>

<body>

    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="custom-menu">
                <a type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars" style="padding-top:5px"></i>
                    <span class="sr-only">Toggle Menu</span>
                </a>
            </div>
            <div class="p-3">
                <h1><a href="indexadmin.php" class="logo"> <img src="Assets/IMG/logo.png" sizes="10px" id="logo" width="100%"> </a></h1>

                <div class="mb-5" style="text-align: center;">
                    <h3 class="h6 mb-3" style="font-size: 18px; font-weight: 600">Bem-vindo(a),<br> <?php foreach ($listaAdmin as $usuario) {
                        if ($usuario['usu_login']==$_SESSION['login']){

						$nome = $usuario['usu_nome'];
                        $arrayNomes = explode(" ", $nome);
                        $doisPrimeirosNomes = array_slice($arrayNomes, 0, 2);
						echo implode(" ", $doisPrimeirosNomes);

                            // echo $usuario['usu_nome'];

                        }
                    } ?>!</h3>
                </div>
                <!--<div style="width: 270px; height: 50px; background: #E2953A;">-->
                <ul class="list-unstyled components mb-3" style="padding-left: 20px">

                    <li>

                        <a href="indexadmin.php">
                            <span class="fa fa-home mr-3"></span>
                            Início
                        </a>
                    </li>

                    <li>
                        <a href="agendamento.php">
                            <span class="fa fa-sticky-note mr-3"></span>
                            Agendamentos
                        </a>
                    </li>
                    <li>
                        <a href="cadastroequipamento.php">
                            <span class="fa fa-wrench mr-3"></span>
                            Equipamentos
                        </a>
                    </li>
                    <li class="active">
                        <a href="cadastrousuario.php">
                            <span class="fa fa-users mr-3"></span>
                            Usuários
                        </a>
                    </li>
                    <li>
                        <a href="https://drive.google.com/file/d/18Cj_oEcWhgiwA4v7E10DPo2WOS0crsNL/view?usp=sharing" target="_blank">
                            <span class="fa fa-question mr-3" style="padding-right:9px"></span>
                            Ajuda
                        </a>
                    </li>

                    <li style="text-align: center; margin-top: 35%; font-size: 18px; margin-right: 22px;">
                        <a href="../Controller/logout.php"><span class="fa fa-sign-out mr-3"></span> Sair</a>
                    </li>
                </ul>
            </div>

            <!--</div>-->
        </nav>
        <div id="content" class="p-4 p-md-5 pt-5">

            <div class="container p-30">
                <div class="row">
                    <div class="col-md-12 main-datatable">
                    
                        <div class="card_body">
                            <div class="row d-flex">
                                <div class="col-sm-6 createSegment">
                                    <button data-abre-modal="#modal-1" class="botao-registro" style="border: none; background: none;"> <a class="btn dim_button create_new" href="#"> <span class="glyphicon glyphicon-plus"></span> Novo Registro </a> </button>
                                    <button style="border: none; background: none;"><a class="btn dim_button create_new" href="cadastrousuarioprofcad.php"> <span class="glyphicon glyphicon-education" style="padding-right: 0.5px"></span> Professores</a></button>
                                </div>
                                <div class="col-sm-6 add_flex">
                                    <div class="form-group searchInput">
                                        <input type="search" class="form-control" id="filterbox" placeholder="Procurar">
                                    </div>
                                </div>
                            </div>
                            <div class="overflow-x">

                                <table style="width: 100%;" id="filtertable" class="table cust-datatable dataTable no-footer">
                                    <thead>
                                        <tr>
                                            <th style="min-width: 90px;">Código</th>
                                            <th style="min-width: 90px;">Nome</th>
                                            <th style="min-width: 90px;">E-mail</th>
                                            <th style="min-width: 90px;">Login</th>
                                            <th style="min-width: 90px;">Senha</th>
                                            <th style="min-width: 90px;">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        foreach ($listaAdmin as $usuario) {
                                            echo
                                            "<tr>
                    <td>" . $usuario['usu_id'] . "</td>
                    <td>" . $usuario['usu_nome'] . "</td>
                    <td>" . $usuario['usu_email'] . "</td>
                    <td>" . $usuario['usu_login'] . "</td>
                    <td>" . $usuario['usu_senha'] . "</td>
                   
                <td>
                <div class='btn-group'>
                    <a class='dropdown dropdown_icon' data-toggle='dropdown'>
                        <i class='fa fa-ellipsis-h'></i>
                    </a>
                    <ul class='dropdown-menu dropdown_more'>
                        
                        <li>
                            <a href='../Controller/rotas.php?acao=excluir&tipo=usuario&codigo=" . $usuario['usu_id'] . "'>
                                <i class='fa fa-trash'></i>Apagar
                            </a>
                        </li>
                        <li>
                       
                         <a  href='cadastrousuario.php?codigo=" . $usuario['usu_id'] . "&nome=" . $usuario['usu_nome'] . "&email=" . $usuario['usu_email'] . "&login=" . $usuario['usu_login'] . "&senha=" . $usuario['usu_senha'] . "#abreModal' data-abre-modal='#modal-1'>
                               <i class='fa fa-pencil-square-o'></i>Editar
                            </a>
                        </li>
                       
                    </ul>
                </div></td>
                   
                   
                   
                </tr>";
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal Estrutura -->
            <div class="grupo-modal">
                <div class="estrutura" id="modal-1">
                    <span class="fechar-modal" id="fechar">&times;</span>
                    <div class="corpo-modal">
                        <div class="form-usu">
                            <div class="titulo">Cadastrar Administrador</div>
                            <form method="POST" action="../Controller/rotas.php?acao=cadastrar&tipo=usuario">
                                <div class="form-corpo">
                                    <div class="campo">
                                        <span class="campo-titulo">Código</span>
                                        <input type="text" name="id" value="<?php
                                                                            echo filter_input(INPUT_GET, "codigo");
                                                                            ?>" readonly placeholder="Código (preenchimento automático)">
                                    </div>
                                    <div class="campo">
                                        <span class="campo-titulo">Nome</span>
                                        <input type="text" name="nome" required value="<?php
                                                                                        echo filter_input(INPUT_GET, "nome");
                                                                                        ?>" autocomplete="off" placeholder="Nome do administrador">
                                    </div>
                                    <div class="campo">
                                        <span class="campo-titulo">E-mail</span>
                                        <input type="email" name="email" required value="<?php
                                                                                            echo filter_input(INPUT_GET, "email");
                                                                                            ?>" autocomplete="off" placeholder="E-mail do administrador">
                                    </div>
                                    <div class="campo">
                                        <span class="campo-titulo">Login</span>
                                        <input type="text" name="login" required value="<?php
                                                                                        echo filter_input(INPUT_GET, "login");
                                                                                        ?>" autocomplete="off" placeholder="Login do administrador">
                                    </div>
                                    <div class="campo">
                                        <span class="campo-titulo">Senha</span>
                                        <input type="password" name="senha" required value="<?php
                                                                                            echo filter_input(INPUT_GET, "senha");
                                                                                            ?>" autocomplete="off" placeholder="Senha do administrador">
                                    </div>
                                    <div class="campo">
                                        <span class="campo-titulo">Nível de usuário</span>
                                        <input type="text" name="nivel" value="1" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="button">
                                    <input type="submit" value="Registrar">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="mascara"></div>
            </div>







        </div>
    </div>
    <script>
       
        function abrirModalPelaURL() {
        if (window.location.hash === '#abreModal') {
            $('#modal-1').modal('show');
        }
    }

    // Executar a função ao carregar a página
    $(window).on('load', function() {
        abrirModalPelaURL();
    });
</script>


    </script>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.14/js/jquery.dataTables.min.js"></script>
    <script src="js/datatable_usu.js"></script>
    <script src="js/modal_Agenda.js"></script>
    






</body>

</html>