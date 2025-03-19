<?php
include_once("../Controller/CUsuario.php");
include('../Controller/verifica_loginprof.php');
include "../Controller/CAgendamento.php";
$listaAgendamento = CAgendamento::retornarAgendamentoTotal();
$listaProfessor = CUsuario::retornarProfessor();
date_default_timezone_set('America/Fortaleza');

?>

<?php
include_once("../DAO/conexao.php");
$conexaoBD = Conexao::criarInstancia();

try {
	$sqlTabela1 = "SELECT COUNT(*) as agendamentos FROM tab_agendamento where agen_status='Agendado'";
	$stmtTabela1 = $conexaoBD->prepare($sqlTabela1);
	$stmtTabela1->execute();
	$resultTabela1 = $stmtTabela1->fetch(PDO::FETCH_ASSOC);

	$sqlTabela2 = "SELECT COUNT(*) as professores FROM tab_user where usu_nivel=2";
	$stmtTabela2 = $conexaoBD->prepare($sqlTabela2);
	$stmtTabela2->execute();
	$resultTabela2 = $stmtTabela2->fetch(PDO::FETCH_ASSOC);

	$sqlTabela3 = "SELECT COUNT(*) as equipamentos FROM tab_equipamento";
	$stmtTabela3 = $conexaoBD->prepare($sqlTabela3);
	$stmtTabela3->execute();
	$resultTabela3 = $stmtTabela3->fetch(PDO::FETCH_ASSOC);

	$sqlTabela4 = "SELECT COUNT(*) as administradores FROM tab_user where usu_nivel=1";
	$stmtTabela4 = $conexaoBD->prepare($sqlTabela4);
	$stmtTabela4->execute();
	$resultTabela4 = $stmtTabela4->fetch(PDO::FETCH_ASSOC);

	$sqlTabela5 = "SELECT COUNT(*) as pendencias FROM tab_agendamento where agen_status='Pendente'";
	$stmtTabela5 = $conexaoBD->prepare($sqlTabela5);
	$stmtTabela5->execute();
	$resultTabela5 = $stmtTabela5->fetch(PDO::FETCH_ASSOC);

	$administradores = $resultTabela4["administradores"];
	$agendamentos = $resultTabela1["agendamentos"];
	$professores = $resultTabela2["professores"];
	$equipamentos = $resultTabela3["equipamentos"];
	$pendencias = $resultTabela5["pendencias"];
} catch (PDOException $e) {
	echo "Erro: " . $e->getMessage();
}

?>

<!doctype html>
<html lang="PT-BR">

<head>
	<title>Tela Inicial</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/dashboard2.css">
	<link rel="icon" type="image/png" href="Assets/IMG/casa.ico">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.14/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,800&display=swap">
	<link rel="stylesheet" href="datatable/css/style.css">

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
				<h1><a href="index.php" class="logo"> <img src="Assets/IMG/logo.png" sizes="10px" id="logo" width="100%"> </a></h1>

				<div class="mb-5" style="text-align: center;">
					<h3 class="h6 mb-3" style="font-size: 18px; font-weight: 600">Bem-vindo(a), <br><?php

																									foreach ($listaProfessor as $usuario) {
																										if ($usuario['usu_login'] == $_SESSION['loginprof']) {

																											$nome = $usuario['usu_nome'];
																											$arrayNomes = explode(" ", $nome);
																											$doisPrimeirosNomes = array_slice($arrayNomes, 0, 2);
																											echo implode(" ", $doisPrimeirosNomes);

																											// echo $usuario['usu_nome'];

																										}
																									}
																									?>!</h3>
				</div>
				<!--<div style="width: 270px; height: 50px; background: #E2953A;">-->
				<ul class="list-unstyled components mb-3" style="padding-left: 20px;">

					<li class="active">

						<a href="index.php" style="color: white;">
							<span class="fa fa-home mr-3"></span> Início</a>
					</li>

					<li>
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

			<!--</div>-->
		</nav>

		<!-- Conteúdo da Página  -->
		<div id="content" class="p-4 p-md-5 pt-5">
			<div class="cardBox">
				<a href="agendamentoprof.php">
					<div class="card" style="font-weight: 450; background-color: rgba(132, 182, 244, 0.74); color: #3B5E7E; box-shadow: 0 2px 10px #737e7f;">
						<div class="elementos">
							<div class="numbers"><?php echo  $agendamentos ?></div>
							<div class="cardName" style="font-weight: 550"> Agendamentos</div>
						</div>
						<div class="iconBx">
							<span class="fa fa-calendar-check-o"></span>
						</div>
					</div>
				</a>
				<a href="equipamentoprof.php">
					<div class="card" style="font-weight: 450; background-color: rgba(250, 220, 155, 0.83); color: #DFA023; box-shadow: 0 2px 10px #737e7f;">
						<div class="elementos">
							<div class="numbers"><?php echo  $equipamentos ?></div>
							<div class="cardName" style="font-weight: 550"> Equipamentos</div>
						</div>
						<div class="iconBx">
							<span class="fa fa-tv"></span>
						</div>
					</div>
				</a>
				<a href="profcadastrados.php">
					<div class="card" style="font-weight: 450; background-color: rgba(119, 221, 119, 0.65); color: #3D8132; box-shadow: 0 2px 10px #737e7f;">
						<div class="elementos">
							<div class="numbers"><?php echo  $professores ?></div>
							<div class="cardName" style="font-weight: 550"> Professores</div>
						</div>
						<div class="iconBx">
							<span class="fa fa-user-o"></span>
						</div>
					</div>
				</a>
				<div class="card" style="font-weight: 450; background-color: rgba(255, 105, 97, 0.64); color: #B43131; box-shadow: 0 2px 10px #737e7f;">
					<div class="elementos">
						<div class="numbers"><?php echo  $pendencias ?></div>
						<div class="cardName" style="font-weight: 550"> Pendências</div>
					</div>
					<div class="iconBx">
						<span class="fa fa-clock-o"></span>
					</div>
				</div>
			</div>
			<div class="card-avisos" style="background-color: #F3C193; width: 100%; height: auto; border-radius: 20px; margin-top: 50px; box-shadow: 0 2px 10px #737e7f;">
				<div class="titulo">
					<h3 class="h6 mb-3" style="font-size: 20px; margin: 30px; padding-top: 20px; font-weight:bold">AVISOS</h3>
				</div>
				<div class="elementos">
					<?php
					function getProfessorLogin($listaProfessor, $professorNome) {
						foreach ($listaProfessor as $professorlogin) {
							if ($professorlogin['usu_nome'] == $professorNome) {
								return $professorlogin['usu_login'];
							}
						}
						return null; 
					}
					
					foreach ($listaAgendamento as $agendamento) {

						$nome = $agendamento['agen_prof'];
						$arrayNomes = explode(" ", $nome);
						$doisPrimeirosNomes = array_slice($arrayNomes, 0, 2);

						$valor = $agendamento['agen_status'];

						$professor = $agendamento['agen_prof'];
						$arrayNomes = explode(" ", $professor);
						$primeiroNome = array_slice($arrayNomes, 0, 1);
						
						$dataagendada = $agendamento['agen_data'];
						$dataagendada = explode("/", $dataagendada);
						list($dia, $mes, $ano) = $dataagendada;
						$dataagendada = "$dia/$mes/$ano";

						$data = date("d/m/Y");
						$data = explode("/", $data);
						list($dia, $mes, $ano) = $data;
						$data = "$dia/$mes/$ano";

						$login = $_SESSION['loginprof'];
						$loginprof = getProfessorLogin($listaProfessor, $agendamento['agen_prof']);

						if ($login == $loginprof ){
							if ($valor == "Pendente") {
								echo "<h6 class='h6 mb-3' style='font-size: 18px; margin: 30px; padding-top: ; font-weight:600'><a href='agendamentoprofindividual.php'><button
									style='background-color: #B43131; border-radius:40px; border: 1px solid black; height:15px; width:15px;  
									border-radius:50%; cursor:pointer'></button></a>
									 " . implode(" ", $doisPrimeirosNomes) . ", você tem o agendamento do(a) " . $agendamento['tipo_nome'] . ": " . $agendamento['equ_nome'] . " pendente do dia " . $agendamento['agen_data'] . "!
								</h6>";
							} else if ($valor == "Agendado" ) {
								if ($dataagendada == $data){
									echo "<h6 class='h6 mb-3' style='font-size: 18px; margin: 30px; padding-top: ; font-weight:600'><a href='agendamentoprofindividual.php'><button
									style='background-color: #3B5E7E; border-radius:40px; border: 1px solid black; height:15px; width:15px;  
									border-radius:50%; cursor:pointer'></button></a>
									 " . implode(" ", $doisPrimeirosNomes) . ", você está com o(a) " . $agendamento['tipo_nome'] . ": " . $agendamento['equ_nome'] . " agendado(a) da " . $agendamento['aula_inicio'] . " até a " . $agendamento['aula_fim'] . " para hoje!
								</h6>";
								} else {
									echo "<h6 class='h6 mb-3' style='font-size: 18px; margin: 30px; padding-top: ; font-weight:600'><a href='agendamentoprofindividual.php'><button
									style='background-color: #3B5E7E; border-radius:40px; border: 1px solid black; height:15px; width:15px;  
									border-radius:50%; cursor:pointer'></button></a>
									 " . implode(" ", $doisPrimeirosNomes) . ", você está com o(a) " . $agendamento['tipo_nome'] . ": " . $agendamento['equ_nome'] . " agendado(a) da " . $agendamento['aula_inicio'] . " até a " . $agendamento['aula_fim'] . " para o dia ". $agendamento['agen_data'] . "!
								</h6>";
								}
								
							} else {
								echo "";
							}
						}
					
					}
					?><br>
				</div>
			</div>
		</div>
	</div>



	<script src="js/jquery.min.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>


</body>

</html>