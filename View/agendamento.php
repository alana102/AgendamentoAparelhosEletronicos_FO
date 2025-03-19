<?php
//Inclusão de arquivos que serão necessários
include "../DAO/conn.php";
include('../Controller/verifica_login.php');
include "../Controller/CAgendamento.php";
include_once("../Controller/CUsuario.php");

//Listagens
$listaAgendamento = CAgendamento::retornarAgendamento();
$listaAdmin = CUsuario::retornarAdmin();

//Definindo o fuso horário em que o sistema vai trabalhar
date_default_timezone_set('America/Fortaleza');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Agendamentos | Hoje</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="icon" type="image/png" href="Assets/IMG/agendamento.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.14/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,800&display=swap">
    <link rel="stylesheet" href="datatable/css/style2.css">
    <link rel="stylesheet" href="css/cad_Agenda.css">
    <link rel="stylesheet" href="css/agen_pdf2.css">
    <link rel="stylesheet" href="css/modal_agen_pdf1.css">
    <link rel="stylesheet" href="css/modal_Agenda2.css">
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

        <!-- Menu lateral -->
        <nav id="sidebar">

            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
            </div>

            <div class="p-3">

                <!-- Logo do sistema no menu lateral -->
                <h1>
                    <a href="indexadmin.php" class="logo"> <img src="Assets/IMG/logo.png" sizes="10px" id="logo" width="100%"></a>
                </h1>

                <!-- Mensagem de boas vindas no menu lateral -->
                <div class="mb-5" style="text-align: center;">
                    <h3 class="h6 mb-3" style="font-size: 18px; font-weight: 600 ">
                        Bem-vindo(a), <br> <?php
                                            foreach ($listaAdmin as $usuario) {
                                                if ($usuario['usu_login'] == $_SESSION['login']) {
                                                    $nome = $usuario['usu_nome'];
                                                    $arrayNomes = explode(" ", $nome);
                                                    $doisPrimeirosNomes = array_slice($arrayNomes, 0, 2);
                                                    echo implode(" ", $doisPrimeirosNomes);
                                                }
                                            } ?>!
                    </h3>
                </div>

                <!-- Lista do menu lateral com todos os links que redirecionam para as outras páginas -->
                <ul class="list-unstyled components mb-3" style="padding-left: 20px;">

                    <li>
                        <a href="indexadmin.php">
                            <span class="fa fa-home mr-3"></span>
                            Início
                        </a>
                    </li>

                    <li class="active">
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

                    <li>
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

        </nav>

        <div id="content" class="p-4 p-md-5 pt-5">
            <!-- Datatable dos agendamentos -->
            <div class="container p-30">
                <div class="row">
                    <div class="col-md-12 main-datatable">

                        <div class="card_body">
                            <div class="row d-flex">
                                <div class="col-sm-8 createSegment">
                                    <button data-abre-modal="#modal-1" id="botao-registro" style="border: none; background: none;"> <a class="btn dim_button create_new" href="#"> <span class="glyphicon glyphicon-plus"></span> Novo Registro </a> </button>
                                    <button style="border: none; background: none;"><a class="btn dim_button create_new" href="agendamentototais.php"> <span class="glyphicon glyphicon-folder-open" style="padding-right: 4px;"></span> Histórico total </a> </button>
                                </div>

                                <div class="col-sm-4 add_flex">
                                    <div class="createSegment" style="display: flex; align-items: center; justify-content: center; ">
                                        <button data-abre-modal="#agen-pdf" style="border: none; background: none; "><a class="btn dim_button create_new" href="#"> <i class="bi bi-file-earmark-pdf-fill"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-pdf-fill" viewBox="0 0 16 16">
                                                        <path d="M5.523 12.424q.21-.124.459-.238a8 8 0 0 1-.45.606c-.28.337-.498.516-.635.572l-.035.012a.3.3 0 0 1-.026-.044c-.056-.11-.054-.216.04-.36.106-.165.319-.354.647-.548m2.455-1.647q-.178.037-.356.078a21 21 0 0 0 .5-1.05 12 12 0 0 0 .51.858q-.326.048-.654.114m2.525.939a4 4 0 0 1-.435-.41q.344.007.612.054c.317.057.466.147.518.209a.1.1 0 0 1 .026.064.44.44 0 0 1-.06.2.3.3 0 0 1-.094.124.1.1 0 0 1-.069.015c-.09-.003-.258-.066-.498-.256M8.278 6.97c-.04.244-.108.524-.2.829a5 5 0 0 1-.089-.346c-.076-.353-.087-.63-.046-.822.038-.177.11-.248.196-.283a.5.5 0 0 1 .145-.04c.013.03.028.092.032.198q.008.183-.038.465z" />
                                                        <path fill-rule="evenodd" d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2m5.5 1.5v2a1 1 0 0 0 1 1h2zM4.165 13.668c.09.18.23.343.438.419.207.075.412.04.58-.03.318-.13.635-.436.926-.786.333-.401.683-.927 1.021-1.51a11.7 11.7 0 0 1 1.997-.406c.3.383.61.713.91.95.28.22.603.403.934.417a.86.86 0 0 0 .51-.138c.155-.101.27-.247.354-.416.09-.181.145-.37.138-.563a.84.84 0 0 0-.2-.518c-.226-.27-.596-.4-.96-.465a5.8 5.8 0 0 0-1.335-.05 11 11 0 0 1-.98-1.686c.25-.66.437-1.284.52-1.794.036-.218.055-.426.048-.614a1.24 1.24 0 0 0-.127-.538.7.7 0 0 0-.477-.365c-.202-.043-.41 0-.601.077-.377.15-.576.47-.651.823-.073.34-.04.736.046 1.136.088.406.238.848.43 1.295a20 20 0 0 1-1.062 2.227 7.7 7.7 0 0 0-1.482.645c-.37.22-.699.48-.897.787-.21.326-.275.714-.08 1.103" />
                                                    </svg></i> </a></button>
                                    </div>
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
                                            <th style="min-width: 90px;">Professor</th>
                                            <th style="min-width: 90px;">Data</th>
                                            <th style="min-width: 90px;">Aula Inicial</th>
                                            <th style="min-width: 90px;">Aula Final</th>
                                            <th style="min-width: 90px;">Situação</th>
                                            <th style="min-width: 90px;">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Funcionalidades necessárias em php  -->
                                        <?php



                                        foreach ($listaAgendamento as $agendamento) {
                                            $id = $agendamento['agen_id'];

                                            //Pegando os dois primeiros nomes de cada professor
                                            $nome = $agendamento['agen_prof'];
                                            $arrayNomes = explode(" ", $nome);
                                            $doisPrimeirosNomes = array_slice($arrayNomes, 0, 2);


                                            $valor = $agendamento['agen_status'];
                                            //Estabelecendo o valor da cor dependendo do status do agendamento
                                            if ($valor == "Concluído") {
                                                $color = "mode mode_concluido";
                                            } else if ($valor == "Pendente") {
                                                $color = "mode mode_pendente";
                                            } else if ($valor == "Agendado") {
                                                $color = "mode mode_agendado";
                                            }

                                            //Data de cada agendamento
                                            $dataagendada = $agendamento['agen_data'];
                                            $dataagendada = explode("/", $dataagendada);
                                            list($dia, $mes, $ano) = $dataagendada;
                                            $dataagendada = new DateTime("$ano-$mes-$dia");

                                            //Data do dia em que você se encontra
                                            $dataAtual = date("Y-m-d");
                                            $dataAtual = new DateTime($dataAtual);

                                            //if else para mudar o status automaticamente para pendente
                                            if ($dataagendada < $dataAtual && $valor != "Concluído") {
                                                require_once "../DAO/conexao.php";
                                                $conexaoBD = Conexao::criarInstancia();

                                                $sql = "UPDATE tab_agendamento set agen_status='Pendente' where agen_id=?";
                                                $stmt = $conexaoBD->prepare($sql);
                                                try {
                                                    $stmt->execute(array($agendamento['agen_id']));
                                                } catch (Exception $ex) {
                                                    echo $ex;
                                                    return 0;
                                                }
                                            }

                                            //if else para definir se o campo "concluir" vai aparecer para o usuário
                                            if ($valor != "Concluído") {
                                                $concluir = "<li>
                                                <a href='../Controller/rotas.php?acao=concluir&tipo=agendamento&codigo=" . $agendamento['agen_id'] . "'' >
                                                    <i class='fa fa-check'></i>Concluir
                                                </a>
                                            </li>";
                                            } else {
                                                $concluir = "";
                                            }

                                            //dados da tabela
                                            echo
                                            "<tr>
                                    <td>" . $agendamento['agen_id'] . "</td>
                                    <td>" . $agendamento['tipo_nome'] . "</td>
                                    <td>" . $agendamento['equ_nome'] . "</td>
                                    <td>" . implode(" ", $doisPrimeirosNomes) . "</td>
                                    <td>" . $agendamento['agen_data'] . "</td>
                                    <td>" . $agendamento['aula_inicio'] . "</td>
                                    <td>" . $agendamento['aula_fim'] . "</td>

                                    <td> <span class='" . $color . "'>" . $agendamento['agen_status'] . "</span> </td>
                                    <td>
                                    
                                        
                                        <div class='btn-group'>
                                            <a class='dropdown dropdown_icon' data-toggle='dropdown' >
                                                <i class='fa fa-ellipsis-h'></i>
                                            </a>
                                            
                                            <ul class='dropdown-menu dropdown_more'>" . $concluir . "
                                    
                                                <li>
                                                    <a href='../Controller/rotas.php?acao=excluir&tipo=agendamento&codigo=" . $agendamento['agen_id'] . "'' >
                                                        <i class='fa fa-trash'></i>Apagar
                                                    </a>
                                                </li>
                                                <li>
                                                    <a data-abre-modal='#modal-1' href='#?codigo=" . $agendamento['agen_id'] .
                                                "&tipo=" . $agendamento['tipo_nome'] .
                                                "&equipamento=" . $agendamento['equ_nome'] .
                                                "&professor=" . $agendamento['agen_prof'] .
                                                "&data=" . $agendamento['agen_data'] .
                                                "&inicio=" . $agendamento['aula_inicio'] .
                                                "&fim=" . $agendamento['aula_fim'] . "' >
                                                        <i class='fa fa-pencil-square-o'></i>
                                                        Editar
                                                    </a>
                                                </li>
                                                <li>
                                                <a id='abrirModal' data-abre-modal='#obsModal_$id' href='#'>
                                                    Mais detalhes
                                                    
                                                </a>
                                            </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                ";
                                        }

                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal de cadastro de agendamento -->
            <div class="grupo-modal">
                <div class="estrutura" id="modal-1">
                    <span class="fechar-modal" id="fechar">&times;</span>
                    <div class="corpo-modal">
                        <div class="form-agenda">
                            <div class="titulo">Cadastrar Agendamento</div>
                            <form method="POST" action="../Controller/rotas.php?acao=cadastrar&tipo=agendamento">
                                <div class="form-corpo">
                                    <div class="campo">
                                        <span class="campo-titulo">Código</span>
                                        <input type="number" name="id" value="<?php
                                                                                echo filter_input(INPUT_GET, "codigo");

                                                                                ?>" readonly placeholder="Código (preenchimento automático)">
                                    </div>
                                    <div class="campo">
                                        <span class="campo-titulo">Categoria</span>
                                        <select name="categoria" id="categoria" required>
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
                                            ?>
                                        </select>
                                    </div>
                                    <div class="campo">
                                        <span class="campo-titulo">Equipamento</span>
                                        <select name="subcategoria" id="subcategoria" required>
                                            <option value="" disabled selected>Selecione um equipamento</option>

                                        </select>
                                    </div>
                                    <div class="campo">
                                        <span class="campo-titulo">Professor</span>
                                        <select name="professor" id="professor" required>
                                            <option value="" disabled selected>Selecione um(a) professor(a)</option>

                                            <?php
                                            $query = $conn->query("SELECT usu_id, usu_nome from tab_user where usu_nivel=2 order by usu_nome asc");
                                            $registros = $query->fetchAll(PDO::FETCH_ASSOC);

                                            foreach ($registros as $option) {
                                            ?>
                                                <option value="<?php echo $option['usu_nome'] ?>"><?php echo $option['usu_nome'] ?></option>
                                            <?php
                                            }
                                            ?>
                                            ?>
                                        </select>
                                    </div>
                                    <div class="campo">
                                        <span class="campo-titulo">Data</span>
                                        <select name="data" id="data" required>
                                            <option value="" disabled selected>Selecione uma data</option>

                                            <?php

                                            function obterDiasUteisDaSemana()
                                            {
                                                $diasUteis = [];
                                                $dataAtual = new DateTime();

                                                // Configura a localização para português do Brasil
                                                setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');

                                                // Obtemos o número do dia da semana (1 para segunda-feira, 2 para terça-feira, etc.)
                                                $diaDaSemana = $dataAtual->format('N');

                                                // Ajustamos a data para a segunda-feira desta semana
                                                $dataAtual->modify('-' . ($diaDaSemana - 1) . ' days');

                                                // Obtemos os próximos 5 dias úteis da semana
                                                for ($i = 0; $i < 6; $i++) {
                                                    $diasUteis[] = clone $dataAtual;
                                                    $dataAtual->modify('+1 day');
                                                }

                                                return $diasUteis;
                                            }

                                            // Obtém os dias úteis da semana
                                            $diasUteis = obterDiasUteisDaSemana();

                                            $dataAtual = new DateTime();
                                            foreach ($diasUteis as $dia) {
                                                $opcaoDesativada = $dia->format('d/m/Y') < $dataAtual->format('d/m/Y') ? 'disabled' : '';
                                                echo '<option value="' . $dia->format('d/m/Y') . '" ' . $opcaoDesativada . '>' . ucfirst(strftime('%A, %d/%m/%Y', $dia->getTimestamp())) . '</option>';
                                            }

                                            ?>
                                        </select>
                                    </div>
                                    <div class="campo">
                                        <span class="campo-titulo">Aula Inicial</span>
                                        <select name="inicio" id="inicio" required>
                                            <option value="" disabled selected>Selecione uma aula</option>

                                            <?php
                                            $query = $conn->query("SELECT aula_id, aula_nome from tab_aulas order by aula_nome asc");
                                            $registros = $query->fetchAll(PDO::FETCH_ASSOC);

                                            foreach ($registros as $option) {
                                            ?>
                                                <option value="<?php echo $option['aula_id'] ?>"><?php echo $option['aula_nome'] ?></option>
                                            <?php
                                            }
                                            ?>
                                            ?>
                                        </select>
                                    </div>
                                    <div class="campo">
                                        <span class="campo-titulo">Aula Final</span>
                                        <select name="fim" id="fim" required>
                                            <option value="" disabled selected>Selecione uma aula</option>

                                            <?php
                                            $query = $conn->query("SELECT aula_id, aula_nome from tab_aulas order by aula_nome asc");
                                            $registros = $query->fetchAll(PDO::FETCH_ASSOC);

                                            foreach ($registros as $option) {
                                            ?>
                                                <option value="<?php echo $option['aula_id'] ?>"><?php echo $option['aula_nome'] ?></option>
                                            <?php
                                            }
                                            ?>
                                            ?>
                                        </select>
                                    </div>
                                    <div class="campo">
                                        <span class="campo-titulo">Observação</span>
                                        <input name="obs" id="" cols="30" rows="10" placeholder="Campo de observação (opcional)">
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

            <!-- Modal do campo de observação -->
            <div class='grupo-modal'>
                <?php foreach ($listaAgendamento as $agendamento) {
                    $id = $agendamento['agen_id'];
                ?>

                    <div class="estrutura" id="obsModal_<?php echo $id; ?>" style="margin:10px">
                        <span class="fechar-modal" id="fechar">&times;</span>
                        <div class="corpo-modal">

                            <div class="observação" style="margin: 20px">
                                <p style="font-weight: 500; font-size:20px">Observação</p>
                                <hr>
                                <div class="texto-quebrado" style="font-size: 17px;">
                                    <?php
                                    if ($agendamento['agen_obs'] != NULL) {
                                        echo $agendamento['agen_obs'];
                                    } else {
                                        echo ("Sem observações");
                                    }

                                    ?>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php  } ?>
                <div id="mascara"></div>
            </div>

            <!-- Modal da documentação em pdf -->
            <div class="grupo-modal_agen_pdf">
                <div class="estrutura_agen_pdf" id="agen-pdf">
                    <span class="fechar-modal_agen_pdf" id="fechar_agen_pdf">&times;</span>
                    <div class="corpo-modal_agen_pdf">
                        <div class="form-agen-pdf">
                            <div class="titulo_agen_pdf">Relatório de Agendamentos</div>
                            <form id="searchForm" action="gerar_pdf/agen_pdf.php" method="post" target="_blank">
                                <div class="form-corpo_agen_pdf">
                                    <div class="campo_agen_pdf">
                                        <label class="campo-titulo_agen_pdf" for="startDate">Data de Início:</label>
                                        <input type="text" id="startDate" name="startDate" placeholder="Insira a data inicial" required maxlength="10" oninput="formatarData(this)" autocomplete="off">
                                    </div>
                                    <div class="campo_agen_pdf">
                                        <label class="campo-titulo_agen_pdf" for="endDate">Data Final:</label>
                                        <input type="text" id="endDate" name="endDate" placeholder="Insira a data final" required maxlength="10" oninput="formatarData(this)" autocomplete="off">
                                    </div>
                                    <div class="button_agen_pdf">
                                        <input type="submit" value="Pesquisar">
                                    </div>
                                </div>
                            </form>
                        </div>

                        <script>
                            document.getElementById("searchForm").addEventListener("submit", function(event) {
                                event.preventDefault();
                                let startDate = document.getElementById("startDate").value;
                                let endDate = document.getElementById("endDate").value;

                                if (startDate === '' || endDate === '') {
                                    alert("Por favor, preencha ambas as datas.");
                                } else {
                                    this.submit();
                                }
                            });
                        </script>

                        <script>
                            function formatarData(input) {
                                var value = input.value.replace(/\D/g, ''); // Remove caracteres não numéricos

                                if (value.length > 4) {
                                    value = value.substring(0, 2) + '/' + value.substring(2, 4) + '/' + value.substring(4, 8);
                                } else if (value.length > 2) {
                                    value = value.substring(0, 2) + '/' + value.substring(2, 4);
                                }

                                input.value = value;
                            }
                        </script>

                    </div>
                </div>
                <div id="mascara-1" class="mascara"></div>
            </div>



            <br><br>
            </form>




        </div>
    </div>

    <!-- scripts em js -->
    <script src="js/funcoes.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.14/js/jquery.dataTables.min.js"></script>
    <script src="js/datatable.js"></script>
    <script src="js/modal_Equi_Categoria1.js"></script>



</body>

</html>