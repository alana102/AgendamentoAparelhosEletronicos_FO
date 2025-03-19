<?php


date_default_timezone_set('America/Fortaleza');
$data = date("d/m/Y");
            $data = explode("/", $data);
            list($dia, $mes, $ano) = $data;
            $data = "$dia/$mes/$ano";

class DAgendamento {
    public static function cadastrarAgendamento( $idtipo, $idequipamento, $professor, $data, $idinicio, $idfim, $obs) {
        
        require_once "conexao.php";
        
        $equipamentoId = $_POST['subcategoria'];
        $data = $_POST['data'];
        $horarioInicio = $_POST['inicio'];
        $horarioFim = $_POST['fim'];

try {
    
    $conexaoBD = Conexao::criarInstancia();
    // Consulte o banco de dados para verificar o agendamento
    $sql = "SELECT COUNT(*) FROM tab_agendamento
            WHERE agen_idequip = ? 
            AND agen_data = ? 
            AND NOT (agen_idaulainicio > ? OR agen_idaulafim < ? )
            AND agen_status = 'Agendado'
        ";

    $stmt = $conexaoBD->prepare($sql);
    $stmt->execute([$equipamentoId, $data, $horarioFim, $horarioInicio]);

    $count = $stmt->fetchColumn();
   

    if ($count > 0) {
        echo "<script>
       
        window.alert('Equipamento já está agendado para esse horário')
        window.location.href='../View/agendamento.php';

        </script>";

       

    } else {
        
        $conexaoBD = Conexao::criarInstancia();
        $sql = "INSERT INTO tab_agendamento(agen_id, agen_idtipo, agen_idequip, agen_prof, agen_data, agen_idaulainicio, agen_idaulafim, agen_obs, agen_status) 
        VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, 'Agendado');";
        $stmt = $conexaoBD->prepare ($sql);

        try {
            $stmt->execute(array($idtipo, $idequipamento, $professor, $data, $idinicio, $idfim, $obs));
            echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Agendamento cadastrado com sucesso')
            window.location.href='../View/agendamento.php';
            </SCRIPT>");
        } catch (Exception $ex) {
            echo $ex;
            return 0;

        }
    }
} catch (PDOException $e) {
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
}


    }

    public static function cadastrarAgendamentoProf( $idtipo, $idequipamento, $professor, $data, $idinicio, $idfim, $obs) {
        
        require_once "conexao.php";
        
        $equipamentoId = $_POST['subcategoria'];
        $data = $_POST['data'];
        $horarioInicio = $_POST['inicio'];
        $horarioFim = $_POST['fim'];

try {
    
    $conexaoBD = Conexao::criarInstancia();
    // Consulte o banco de dados para verificar o agendamento
    $sql = "SELECT COUNT(*) FROM tab_agendamento
            WHERE agen_idequip = ? 
            AND agen_data = ? 
            AND NOT (agen_idaulainicio > ? OR agen_idaulafim < ?)
            AND agen_status = 'Agendado'" ;

        

    $stmt = $conexaoBD->prepare($sql);
    $stmt->execute([ $equipamentoId, $data, $horarioFim, $horarioInicio]);

    $count = $stmt->fetchColumn();

    if ($count > 0) {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Equipamento já está agendado para esse horário')
        window.location.href='../View/agendamentoprofindividual.php';
        </SCRIPT>");

    } else {
        
        $conexaoBD = Conexao::criarInstancia();
        $sql = "INSERT INTO tab_agendamento(agen_id, agen_idtipo, agen_idequip, agen_prof, agen_data, agen_idaulainicio, agen_idaulafim, agen_obs, agen_status) 
        VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, 'Agendado');";
        $stmt = $conexaoBD->prepare ($sql);

        try {
            $stmt->execute(array($idtipo, $idequipamento, $professor, $data, $idinicio, $idfim, $obs));
            echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Agendamento cadastrado com sucesso')
            window.location.href='../View/agendamentoprofindividual.php';
            </SCRIPT>");
        } catch (Exception $ex) {
            echo $ex;
            return 0;

        }
    }
} catch (PDOException $e) {
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
}


    }

    public static function carregarAgendamento(){

        date_default_timezone_set('America/Fortaleza');
        $data = date("d/m/Y");
        $data = explode("/", $data);
        list($dia, $mes, $ano) = $data;
        $data = "$dia/$mes/$ano";

        require_once "conexao.php";
        $conexaoBD = Conexao::criarInstancia();

        $sql = "SELECT tab_agendamento.agen_id,
        tab_equitipo.tipo_nome,
        tab_equipamento.equ_nome, 
        tab_agendamento.agen_prof, 
        tab_agendamento.agen_data, 
        i.aula_nome as aula_inicio,
        f.aula_nome as aula_fim,
        tab_agendamento.agen_obs,
        tab_agendamento.agen_status
        FROM tab_agendamento 
        join tab_equitipo on tab_agendamento.agen_idtipo=tab_equitipo.tipo_id   
        join tab_equipamento on tab_agendamento.agen_idequip=tab_equipamento.equ_id 
        join tab_aulas i on tab_agendamento.agen_idaulainicio=i.aula_id 
        join tab_aulas f on tab_agendamento.agen_idaulafim=f.aula_id where agen_data='$data'
        order by tab_agendamento.agen_id desc;";

        try {
            $stmt = $conexaoBD->query($sql);
            return $stmt->fetchAll();
        } catch (Exception $ex) {
            echo $ex;
            return 0;
        }
    }

    public static function carregarAgendamentoTotal(){

     
        require_once "conexao.php";
        $conexaoBD = Conexao::criarInstancia();

        $sql = "SELECT tab_agendamento.agen_id,
        tab_equitipo.tipo_nome,
        tab_equipamento.equ_nome, 
        tab_agendamento.agen_prof, 
        tab_agendamento.agen_data, 
        i.aula_nome as aula_inicio,
        f.aula_nome as aula_fim,
        tab_agendamento.agen_obs,
        tab_agendamento.agen_status
        FROM tab_agendamento 
        join tab_equitipo on tab_agendamento.agen_idtipo=tab_equitipo.tipo_id   
        join tab_equipamento on tab_agendamento.agen_idequip=tab_equipamento.equ_id 
        join tab_aulas i on tab_agendamento.agen_idaulainicio=i.aula_id 
        join tab_aulas f on tab_agendamento.agen_idaulafim=f.aula_id 
        order by tab_agendamento.agen_id desc;";

        try {
            $stmt = $conexaoBD->query($sql);
            return $stmt->fetchAll();
        } catch (Exception $ex) {
            echo $ex;
            return 0;
        }
    }


    public static function excluirAgendamento($codigo){
        require_once "conexao.php";
        $conexaoBD = Conexao::criarInstancia();

        $sql = "DELETE FROM tab_agendamento where agen_id=?";

       $stmt = $conexaoBD->prepare ($sql);

        try {
            $stmt->execute(array($codigo));
            header("location: ../View/agendamento.php");
        } catch (Exception $ex) {
            
            echo $ex;
            return 0;
        }
    }

    public static function editarAgendamento($codigo, $categoria, $equipamento, $professor, $data, $inicio, $fim, $obs){
        require_once "conexao.php";
        $conexaoBD = Conexao::criarInstancia();

        $sql = "UPDATE tab_agendamento set agen_idequip=?, agen_idequip=?, agen_idprof=?, agen_data=?, agen_idaulainicio=?, agen_idaulafim=?, agen_obs=? where agen_id=?";

       $stmt = $conexaoBD->prepare ($sql);

        try {
            $stmt->execute(array($categoria, $equipamento, $professor, $data, $inicio, $fim, $obs, $codigo));
            header("location: ../View/agendamento.php");
        } catch (Exception $ex) {
            echo $ex;
            return 0;
        }
    }

    public static function editarAgendamentoProf($codigo, $categoria, $equipamento, $professor, $data, $inicio, $fim, $obs){
        require_once "conexao.php";
        $conexaoBD = Conexao::criarInstancia();

        $sql = "UPDATE tab_agendamento set agen_idequip=?, agen_idequip=?, agen_idprof=?, agen_data=?, agen_idaulainicio=?, agen_idaulafim=?, agen_obs=? where agen_id=?";

       $stmt = $conexaoBD->prepare ($sql);

        try {
            $stmt->execute(array($categoria, $equipamento, $professor, $data, $inicio, $fim, $obs, $codigo));
            header("location: ../View/agendamentoprof.php");
        } catch (Exception $ex) {
            echo $ex;
            return 0;
        }
    }

    public static function concluirAgendamento($codigo){
        require_once "conexao.php";
        $conexaoBD = Conexao::criarInstancia();

        $sql = "UPDATE tab_agendamento set agen_status='Concluído' where agen_id=?";

       $stmt = $conexaoBD->prepare ($sql);

        try {
            $stmt->execute(array($codigo));
            header("location: ../View/agendamento.php");
        } catch (Exception $ex) {
            echo $ex;
            return 0;
        }
    }

    public static function concluirAgendamentoProf($codigo){
        require_once "conexao.php";
        $conexaoBD = Conexao::criarInstancia();

        $sql = "UPDATE tab_agendamento set agen_status='Concluído' where agen_id=?";

       $stmt = $conexaoBD->prepare ($sql);

        try {
            $stmt->execute(array($codigo));
            header("location: ../View/agendamentoprofindividual.php");
        } catch (Exception $ex) {
            echo $ex;
            return 0;
        }
    }
  

    
    
}



?>