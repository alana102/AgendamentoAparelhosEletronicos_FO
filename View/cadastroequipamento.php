<?php
include('../Controller/verifica_login.php');
include "../DAO/conn.php";
include "../Controller/CEquipamento.php";
include_once("../Controller/CUsuario.php");
$listaAdmin = CUsuario::retornarAdmin();

$listaEquipamento = CEquipamento::retornarEquipamento();



?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipamentos</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="icon" type="image/png" href="Assets/IMG/equipamento.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.14/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,800&display=swap">
    <link rel="stylesheet" href="datatable/css/style2.css">


    <link rel="stylesheet" href="css/cad_Equi1.css">
    <link rel="stylesheet" href="css/modal_Equi3.css">
    <link rel="stylesheet" href="css/teste.css">

    <style>
        .texto-quebrado {
            display: inline-block;
            overflow: hidden;
            text-overflow: ellipsis;
            width: calc(30em + 1px);
            max-width: 100%;
        }

        @media (max-width: 584px) {
            .texto-quebrado {
                display: inline-block;
                overflow: hidden;
                text-overflow: ellipsis;
                width: calc(15em + 1px);
                max-width: 100%;
            }

        }
    </style>
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
                    <h3 class="h6 mb-3" style="font-size: 18px; font-weight: 600">Bem-vindo(a), <br><?php foreach ($listaAdmin as $usuario) {
                                                                                                        if ($usuario['usu_login'] == $_SESSION['login']) {

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
                        <a href="agendamento.php"><span class="fa fa-sticky-note mr-3"></span>
                            Agendamentos
                        </a>
                    </li>
                    <li class="active">
                        <a href="cadastroequipamento.php"><span class="fa fa-wrench mr-3"></span>
                            Equipamentos
                        </a>
                    </li>
                    <li>
                        <a href="cadastrousuario.php"><span class="fa fa-users mr-3"></span>
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
                                <div class="col-sm-4 createSegment">
                                    <button data-abre-modal="#modal-1" id="botao-registro" style="border: none; background: none;"> <a class="btn dim_button create_new" href="#"> <span class="glyphicon glyphicon-plus"></span> Novo Registro </a> </button>
                                </div>
                                <div class="col-sm-8 add_flex">
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
                                            <th style="min-width: 90px;">Categoria</th>
                                            <th style="min-width: 90px;">Equipamento</th>
                                            <th style="min-width: 90px;">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        foreach ($listaEquipamento as $equipamento) {
                                            $id = $equipamento['equ_id'];  
                                            echo
                                            "<tr>
                    <td>" . $equipamento['equ_id'] . "</td>
                    <td>" . $equipamento['tipo_nome'] . "</td>
                    <td>" . $equipamento['equ_nome'] . "</td>
                   
                <td>
                <div class='btn-group'>
                    <a class='dropdown dropdown_icon' data-toggle='dropdown'>
                        <i class='fa fa-ellipsis-h'></i>
                    </a>
                    <ul class='dropdown-menu dropdown_more'>
                        
                        <li>
                            <a href='../Controller/rotas.php?acao=excluir&tipo=equipamento&codigo=" . $equipamento['equ_id'] . "' >
                                <i class='fa fa-trash'></i>Apagar
                            </a>
                        </li>
                        <li>
                            <a data-abre-modal='#modal-1' href='#?codigo=" . $equipamento['equ_id'] . "&categoria=" . $equipamento['tipo_nome'] . "&nome=" . $equipamento['equ_nome'] . "'>
                                <i class='fa fa-pencil-square-o'></i>Editar
                            </a>
                        </li>
                        <li>
                        <a id='abrirModal' data-abre-modal='#obsModal_$id' href='#'>
                        Mais detalhes
                        
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
                <div id="modal-1" class="estrutura">
                    <span class="fechar-modal" id="fechar-1">&times;</span>
                    <div class="corpo-modal">
                        <div class="form-equi">
                            <div class="titulo">Cadastrar Equipamento</div>
                            <form method="POST" action="../Controller/rotas.php?acao=cadastrar&tipo=equipamento">
                                <div class="form-corpo">
                                    <div class="campo">
                                        <span class="campo-titulo">Código</span>
                                        <input type="text" readonly placeholder="Código (preenchimento automático)" name="id" value="<?php echo filter_input(INPUT_GET, "codigo"); ?>">
                                    </div>
                                    <div class="campo">
                                        <span class="campo-titulo">Categoria</span>
                                        <select name="categoria" required>
                                            <option value="" disabled selected>Selecione uma categoria</option>
                                            <?php
                                            $query = $conn->query("SELECT tipo_id, tipo_nome from tab_equitipo order by tipo_nome asc");
                                            $registros = $query->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($registros as $option) {
                                            ?>
                                                <option value="<?php echo $option['tipo_id'] ?>"><?php echo $option['tipo_nome'] ?></option>
                                            <?php
                                            }
                                            ?>

                                        </select>
                                        <p style="padding-top: 10px;">Não encontrou a categoria?
                                            <span data-toggle="modal" data-abre-modal="#modal-2" style="color: #E2953A; font-weight: 600; text-decoration: none; border: none; background: none; cursor: pointer;">CRIE UMA</span>
                                        </p>
                                    </div>
                                    <div class="campo">
                                        <span class="campo-titulo">Equipamento</span>
                                        <input type="text" name="equipamento" required autocomplete="off" placeholder="Nome do equipamento" value="<?php echo filter_input(INPUT_GET, "nome"); ?>">
                                    </div>
                                    <div class="campo">
                                        <span class="campo-titulo">Observação</span>
                                        <textarea name="obs" id="" cols="30" rows="10" placeholder="Campo de observação (opcional)"></textarea>
                                    </div>
                                </div>
                                <div class="button">
                                    <input type="submit" value="Registrar">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="mascara-1" class="mascara"></div>
            </div>

            <div class="grupo-modal">
                <div id="mascara"></div>
                <div id="modal-2" class="estrutura">
                    <span class="fechar-modal" id="fechar-2">&times;</span>
                    <div class="corpo-modal">
                        <div class="form-equi">
                            <div class="titulo">Cadastrar Categoria</div>
                            <form method="POST" action="../Controller/rotas.php?acao=cadastrar&tipo=categoria">
                                <div class="form-corpo">
                                    <div class="campo">
                                        <span class="campo-titulo">Código </span>
                                        <input type="text" placeholder="Código (preenchimento automático)" name="id" readonly>
                                    </div>
                                    <div class="campo">
                                        <span class="campo-titulo">Categoria</span>
                                        <input type="text" placeholder="Nome da Categoria" name="nome" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="button">
                                    <input type="submit" value="Registrar">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="mascara-2" class="mascara"></div>
            </div>



            <!-- Modal do campo de observação -->
            <div class='grupo-modal'>
                <?php foreach ($listaEquipamento as $equipamento) {
                    $id = $equipamento['equ_id'];
                ?>

                    <div class="estrutura" id="obsModal_<?php echo $id; ?>" style="margin:10px">
                        <span class="fechar-modal" id="fechar">&times;</span>
                        <div class="corpo-modal">

                            <div class="observação" style="margin: 20px">
                                <p style="font-weight: 500; font-size:20px">Observação</p>
                                <hr>
                                <div class="texto-quebrado" style="font-size: 17px;">
                                    <?php
                                    if ($equipamento['equ_obs'] != NULL) {
                                        echo $equipamento['equ_obs'];
                                    } else {
                                        echo ("Sem observações");
                                    }

                                    ?>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php  } ?>
                <div id="mascara-1"></div>
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
    <script src="js/datatable_equi.js"></script>
    <script src="js/modal_Equi_Categoria1.js"></script>
</body>

</html>