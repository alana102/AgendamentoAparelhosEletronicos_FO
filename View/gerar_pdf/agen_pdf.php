<?php
require_once '../vendor/autoload.php'; // Inclua o arquivo de autoload do Dompdf

use Dompdf\Dompdf;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $startDate = $_POST["startDate"];
    $endDate = $_POST["endDate"];

    // Verifica se as datas são válidas
    $startDateObj = DateTime::createFromFormat('d/m/Y', $startDate);
    $endDateObj = DateTime::createFromFormat('d/m/Y', $endDate);

    if ($startDateObj !== false && $endDateObj !== false && $startDateObj <= $endDateObj) {

        // Estabelece a conexão com o banco de dados
        $conexao = novaConexao();
        $conexao->exec("set names utf8");

        // Prepara a consulta SQL para buscar os dados entre as datas
        $sql = "SELECT a.agen_id,
            t.tipo_nome,
            e.equ_nome, 
            a.agen_prof, 
            DATE_FORMAT(STR_TO_DATE(a.agen_data, '%d/%m/%Y'), '%d/%m/%Y') as agen_data_formatada, 
            i.aula_nome as aula_inicio,
            f.aula_nome as aula_fim,
            a.agen_obs,
            a.agen_status
            FROM tab_agendamento a
            INNER join tab_equitipo t on a.agen_idtipo=t.tipo_id   
            INNER join tab_equipamento e on a.agen_idequip=e.equ_id 
            INNER join tab_aulas i on a.agen_idaulainicio=i.aula_id 
            INNER join tab_aulas f on a.agen_idaulafim=f.aula_id
            WHERE STR_TO_DATE(a.agen_data, '%d/%m/%Y') BETWEEN STR_TO_DATE(:startDate, '%d/%m/%Y') AND STR_TO_DATE(:endDate, '%d/%m/%Y') ORDER BY a.agen_id DESC";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':startDate', $startDate);
        $stmt->bindParam(':endDate', $endDate);
        $stmt->execute();

        // Obter os resultados da consulta
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Verifica se há resultados
        if ($resultados) {
            // Construir a tabela Bootstrap com os resultados
            $content = "
            <!DOCTYPE html>
            <html lang='pt-br'>
            <head>
                <meta charset='UTF-8'>
                <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css'>
                <style>
                    table {
                        width: 100%;
                        border-collapse: collapse;
                        margin-bottom: 15px;
                    }
                    th, td {
                        border: 1px solid #ddd;
                        padding: 8px;
                        text-align: left;
                    }
                    th {
                        background-color: #f2f2f2;
                    }
                    body {
            font-family: Arial, sans-serif;
        }
                </style>
            </head>
            <body >";
            $content .= "
                <h1>Dados entre $startDate e $endDate</h1> <br> <br>
                <table class='table'>
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Categoria</th>
                            <th>Equipamento</th>
                            <th>Professor</th>
                            <th>Data</th>
                            <th>Aula Inicial</th>
                            <th>Aula Final</th>
                            <th>Observação</th>
                            <th>Situação</th>
                        </tr>
                    </thead>
                    <tbody>";

            foreach ($resultados as $linha) {
                $content .= "
                    <tr>
                        <td>{$linha['agen_id']}</td>
                        <td>{$linha['tipo_nome']}</td>
                        <td>{$linha['equ_nome']}</td>
                        <td>{$linha['agen_prof']}</td>
                        <td>{$linha['agen_data_formatada']}</td>
                        <td>{$linha['aula_inicio']}</td>
                        <td>{$linha['aula_fim']}</td>
                        <td>{$linha['agen_obs']}</td>
                        <td>{$linha['agen_status']}</td>
                    </tr>";
            }

            $content .= "
                </tbody>
            </table>
            <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js' integrity='sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r' crossorigin='anonymous'></script>
            <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js' integrity='sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+' crossorigin='anonymous'></script>
            </body>";

            // Cria uma nova instância do Dompdf
            $dompdf = new Dompdf();
            $dompdf->loadHtml($content);

            $dompdf->setPaper('A4', 'landscape');

            // Renderiza o conteúdo HTML no PDF
            $dompdf->render();

            // Define o nome do arquivo PDF gerado
            $pdfFileName = "relatorio_$startDate-$endDate.pdf";

            // Saída do PDF para exibir em uma nova guia
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="' . $pdfFileName . '"');
            header('Content-Transfer-Encoding: binary');
            header('Accept-Ranges: bytes');

            // Exibe o PDF gerado
            echo $dompdf->output();
        } else {
          /* echo "<script>
            window.alert('Nenhum registro encontrado entre $startDate e $endDate</h2>')
            window.location.href='../View/agendamento.php';</script"; */
            // Se não houver resultados, exiba uma mensagem ou tome outra ação
           echo "<h2>Nenhum registro encontrado entre $startDate e $endDate</h2>";
        }
    } else {
        echo "<h2>Por favor, insira datas válidas.</h2>";
    }
}

// Função para criar a conexão com o banco de dados (substitua com suas credenciais)
function novaConexao() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "agendamentofo";

    try {
        $conexao = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexao;
    } catch (PDOException $e) {
        die("Erro na conexão com o banco de dados: " . $e->getMessage());
    }
}
?>
