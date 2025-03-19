<?php
$data = date("d/m/Y");
$data = explode("/", $data);
list($dia, $mes, $ano) = $data;

// Adiciona um dia à data
$data = mktime(0, 0, 0, $mes, $dia + 1, $ano);
$dataa = mktime(0, 0, 0, $mes, $dia + 2, $ano);
$datab = mktime(0, 0, 0, $mes, $dia + 3, $ano);
$datac = mktime(0, 0, 0, $mes, $dia + 4, $ano);
$datad = mktime(0, 0, 0, $mes, $dia + 5, $ano);

// Formata a nova data
$data1 = date("d/m/Y", $data);
$data2 = date("d/m/Y", $dataa);
$data3 = date("d/m/Y", $datab);
$data4 = date("d/m/Y", $datac);
$data5 = date("d/m/Y", $datad);

echo $data1;
echo $data2;
echo $data3;
echo $data4;
echo $data5;
