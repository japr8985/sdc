<?php 
include("../conexion/conexion.php");
//consulta SQL
$sql = "SELECT * FROM registros_total";
//ejecucion del query
$query = $mysqli->query($sql) or die($mysqli->error);
$data = array();
//desgloce
while ($result = $query->fetch_array()) {
	//impresion
	$data[] = $result;
	}

var_dump($data);
 ?>