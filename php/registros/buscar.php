<?php 
	include ("../../conexion/conexion.php");
	//capturando el valor enviado
	$cod = $_REQUEST['data'];
	//consulta
	$sql = "SELECT SELECT registros_total.*, disciplina.simbolo AS Disciplina from registros_total, disciplina where codpdvsa like '%$cod%' and disciplina.Disciplina = registros_total.Disciplina limit 0,1";
	//ejecucion de la consulta
	$query = $mysqli->query($sql);
	//desgloce de la data
	$result = $query->fetch_array();
	//----------------------------------------
	$sql = "SELECT count(id) FROM registros_total where id < ".$result['ID'];
	$query = $mysqli->query($sql);
	$num =$query->fetch_array();
	$num = $num[0]+1;
	//----------------------------------------
	$data = array(
		"Number"				=> $num,
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