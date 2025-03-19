<?php
include "../DAO/conn.php";

$categoria = $_GET['categoria'];

$query = $conn->prepare("SELECT equ_id, equ_nome from tab_equipamento where equ_tipoid=:equ_tipoid order by equ_nome asc");

$data = ['equ_tipoid' => $categoria];
$query->execute($data);
$registros = $query->fetchAll(PDO::FETCH_ASSOC);

echo '<option value="" disabled selected>Selecione um equipamento</option>';

foreach ($registros as $option) {
?> <option value="<?php echo $option['equ_id'] ?>"><?php echo $option['equ_nome'] ?></option>
<?php
}

?>