<?php
// Includes de arquivos necessários
include_once "../DAO/conn.php";
include('../Controller/verifica_loginprof.php');
include "../Controller/CAgendamento.php";
include_once("../Controller/CUsuario.php");

// Listagens
$listaProfessor = CUsuario::retornarProfessor();
$listaAgendamento = CAgendamento::retornarAgendamento();

// Definição do fuso horário
date_default_timezone_set('America/Fortaleza');

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar equipamento</title>
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
    <!-- Menu lateral -->
    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
            </div>
            <div class="p-3">
                <h1><a href="index.php" class="logo"> <img src="Assets/IMG/logo.png" sizes="10px" id="logo" width="100%"> </a></h1>

                <div class="mb-5" style="text-align: center; font-weight: 600">
                    <h3 class="h6 mb-3" style="font-size: 18px; font-weight: 600">Bem-vindo(a),<br> <?php foreach ($listaProfessor as $usuario) {
                                                                                                        if ($usuario['usu_login'] == $_SESSION['loginprof']) {
                                                                                                            // Definição do nome que aparece na mensagem de boas vindas 
                                                                                                            $nome = $usuario['usu_nome'];
                                                                                                            $arrayNomes = explode(" ", $nome);
                                                                                                            $doisPrimeirosNomes = array_slice($arrayNomes, 0, 2);
                                                                                                            echo implode(" ", $doisPrimeirosNomes);
                                                                                                        }
                                                                                                    } ?>!</h3>
                </div>
                <ul class="list-unstyled components mb-3" style="padding-left: 20px;">

                    <li>

                        <a href="index.php">
                            <span class="fa fa-home mr-3"></span> Início</a>
                    </li>

                    <li class="active">
                        <a href="agendamentoprofindividual.php"><span class="fa fa-sticky-note mr-3"></span> Agendamentos</a>
                    </li>
                    <li>
                        <a href="equipamentoprof.php"><span class="fa fa-wrench mr-3"></span> Equipamentos</a>
                    </li>
                    <li>
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


        </nav>
        <div id="content" class="p-4 p-md-5 pt-5">

            <!-- Datatable dos agendamentos -->
            <div class="container p-30">
                <div class="row">
                    <div class="col-md-12 main-datatable">

                        <div class="card_body">
                            <div class="row d-flex">
                                <div class="col-sm-6 createSegment">
                                    <button data-abre-modal="#modal-1" id="botao-registro" style="border: none; background: none;"> <a class="btn dim_button create_new" href="#"> <span class="glyphicon glyphicon-plus"></span> Novo Registro </a> </button>
                                    <button style="border: none; background: none;"> <a class="btn dim_button create_new" href="agendamentoprofindividual.php"> <span class="glyphicon glyphicon-user"></span> Meus Agendamentos</a> </button>
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
                                        <?php

                                        //Função para pegar o login do professor
                                        function getProfessorLogin($listaProfessor, $professorNome)
                                        {
                                            foreach ($listaProfessor as $professorlogin) {
                                                if ($professorlogin['usu_nome'] == $professorNome) {
                                                    return $professorlogin['usu_login'];
                                                }
                                            }
                                            return null;
                                        }

                                        //Funcionalidades em php
                                        foreach ($listaAgendamento as $agendamento) {
                                            $id = $agendamento['agen_id'];
                                            $login = $_SESSION['loginprof'];
                                            $loginprof = getProfessorLogin($listaProfessor, $agendamento['agen_prof']);

                                            //Pega os dois primeiros nomes do professor
                                            $nome = $agendamento['agen_prof'];
                                            $arrayNomes = explode(" ", $nome);
                                            $doisPrimeirosNomes = array_slice($arrayNomes, 0, 2);

                                            $valor = $agendamento['agen_status'];

                                            //if e else para definir a cor que estará no campo de status de acordo com informações do banco
                                            if ($valor == "Concluído") {
                                                $color = "mode mode_concluido";
                                            } else if ($valor == "Pendente") {
                                                $color = "mode mode_pendente";
                                            } else if ($valor == "Agendado") {
                                                $color = "mode mode_agendado";
                                            }


                                            $dataagendada = $agendamento['agen_data'];
                                            $dataagendada = explode("/", $dataagendada);
                                            list($dia, $mes, $ano) = $dataagendada;
                                            // Certifique-se de que você está fornecendo a data no formato correto
                                            $dataagendada = new DateTime("$ano-$mes-$dia");

                                            $dataAtual = date("Y-m-d");
                                            $dataAtual = new DateTime($dataAtual);

                                            //comando que altera o status do agendamento para pendente
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

                                            //if e else para definir o que vai aparecer no menu de ações caso o agendamento estiver concluído ou não
                                            if ($valor != "Concluído") {
                                                $concluir = "<li>
                                                <a href='../Controller/rotas.php?acao=concluir&tipo=agendamentoprof&codigo=" . $agendamento['agen_id'] . "'' >
                                                    <i class='fa fa-check'></i>Concluir
                                                </a>
                                            </li>";
                                            } else {
                                                $concluir = "";
                                            }

                                            $professor = $agendamento['agen_prof'];

                                            //comando que permite que o professor so tenha acesso às ações dos seus agendamentos e de mais nenhum outro prof
                                            if ($login == $loginprof) {
                                                $acoes = "<ul class='dropdown-menu dropdown_more'>" . $concluir . "
                                    
                                        
                                        <li>
                                            <a href='agendamentoprof.php?codigo=" . $agendamento['agen_id'] .
                                                    "&tipo=" . $agendamento['tipo_nome'] .
                                                    "&equipamento=" . $agendamento['equ_nome'] .
                                                    "&professor=" . $agendamento['agen_prof'] .
                                                    "&data=" . $agendamento['agen_data'] .
                                                    "&inicio=" . $agendamento['aula_inicio'] .
                                                    "&fim=" . $agendamento['aula_fim'] . "' >
                                                <i class='fa fa-pencil-square-o'></i>Editar
                                            </a>
                                        </li>
                                        <li>
                                        <a id='abrirModal' data-abre-modal='#obsModal_$id' href='#'>
                                        Mais detalhes
                                        
                                    </a>
                                        </li>
                                    </ul>";
                                            } else {
                                                $acoes = "<ul class='dropdown-menu dropdown_more'>
                                        <li>
                                        <a id='abrirModal' data-abre-modal='#obsModal_$id' href='#'>
                                        Mais detalhes
                                        
                                    </a>
                                        </li>
                                    </ul>";
                                            }

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
                                            <a class='dropdown dropdown_icon' data-toggle='dropdown'>
                                                <i class='fa fa-ellipsis-h'></i>
                                            </a>
                                            " . $acoes . "
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

            <!-- Modal Estrutura -->
            <div class="grupo-modal">
                <div class="estrutura" id="modal-1">
                    <span class="fechar-modal" id="fechar">&times;</span>
                    <div class="corpo-modal">
                        <div class="form-agenda">
                            <div class="titulo">Cadastrar Agendamento</div>
                            <form method="POST" action="../Controller/rotas.php?acao=cadastrar&tipo=agendamentoprof">
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
                                        <input name="professor" type="text" value="<?php
                                                                                    foreach ($listaProfessor as $usuario) {
                                                                                        if ($usuario['usu_login'] == $_SESSION['loginprof']) {
                                                                                            echo $usuario['usu_nome'];
                                                                                        }
                                                                                    } ?>" readonly>
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

        </div>
                                </div>

        <script src="js/jquery.min.js"></script>
        <script src="js/popper.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
        <script src="js/funcoes.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.14/js/jquery.dataTables.min.js"></script>
        <script src="js/datatable.js"></script>
        <script src="js/modal_Agenda.js"></script>
</body>

</html>