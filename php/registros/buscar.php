<?php 
	include ("../../conexion/conexion.php");
	//capturando el valor enviado
	$cod = $_REQUEST['data'];
	//consulta
	$sql = "SELECT * from registros_total where codpdvsa like '%$cod%' limit 0,1";
	//ejecucion de la consulta
	$query = $mysqli->query($sql);
	//desgloce de la data
	$result = $query->fetch_array();
	var_dump($result);
	$data = array(
		"ID" 						=> $result['ID'],
		"CodPdvsa" 			=> $result['CodPdvsa'],
		"Descripcion" 	=> utf8_encode($result['Descripcion']),
		"Rev" 					=> $result['Rev'],
		"Fecha_Rev" 		=> $result['Fecha_Rev'],
		"CodCliente" 		=> $result['CodCliente'],
		"Disciplina" 		=> $result['Disciplina'],
		"Status" 				=> $result['Status'],
		"Fase" 					=> $result['Fase']);
	echo json_encode($data);
 ?>