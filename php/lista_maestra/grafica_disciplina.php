<?php 
include("../../conexion/conexion.php");
ini_set('display_errors', 1);

//$sql = "SELECT disciplina, count(id) as num FROM registros_total GROUP BY disciplina";
$sql = "SELECT count(registros_total.id) as num, disciplina.disciplina as disciplina from registros_total, disciplina WHERE disciplina.simbolo = registros_total.disciplina group by registros_total.disciplina";
$query = $mysqli->query($sql);

$result = [];

while ($r = $query->fetch_array()) {
	$result[] = ['name' => $r['disciplina'], 'y' => intval($r['num'])];
}

echo json_encode($result);


 ?>