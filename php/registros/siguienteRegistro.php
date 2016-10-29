<?php 
	include ("../../conexion/conexion.php");
	$id = $_REQUEST['id'];
	$sql = "SELECT registros_total.*, disciplina.simbolo AS Disciplina FROM registros_total, disciplina WHERE id = (SELECT min(id) FROM registros_total where id > $id) and disciplina.Disciplina = registros_total.Disciplina";
	//ejecucion de consulta SQL
	$query = $mysqli->query($sql) or die($mysqli->error);
	//desgloce de la data
	$result = $query->fetch_array();
	//----------------------------------------
	$sql = "SELECT count(id) FROM registros_total where id < ".$result['ID'];
	$query = $mysqli->query($sql);
	$num =$query->fetch_array();
	$num = $num[0]+1;
	//----------------------------------------
	//echo $result['Descripcion'];
	//codificacion e impresion del json
	$data = array(
		"Number"		=> $num,
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