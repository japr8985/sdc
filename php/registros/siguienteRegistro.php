<?php 
	include ("../../conexion/conexion.php");
	$id = $_REQUEST['id'];
	$sql = "SELECT * FROM registros_total WHERE id = (SELECT min(id) FROM registros_total where id > $id)";
	//ejecucion de consulta SQL
	$query = $mysqli->query($sql) or die($mysqli->error);
	//desgloce de la data
	$result = $query->fetch_array();
	//echo $result['Descripcion'];
	//codificacion e impresion del json
	$data = array(
		"ID" 			=> $result['ID'],
		"CodPdvsa" 		=> $result['CodPdvsa'],
		"Descripcion" 	=> utf8_encode($result['Descripcion']),
		"Rev" 			=> $result['Rev'],
		"Fecha_Rev" 	=> $result['Fecha_Rev'],
		"CodCliente" 	=> $result['CodCliente'],
		"Disciplina" 	=> $result['Disciplina'],
		"Status" 		=> $result['Status'],
		"Fase" 			=> $result['Fase']);
	echo json_encode($data);
 ?>