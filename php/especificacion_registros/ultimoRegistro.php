<?php 
	//inlcuir el archivo de conexion
	include('../../conexion/conexion.php');
	//consulta SQL -> selecciona todo de registros_total ordenados por el id de manera desc (del mayor al menor)
	//con un limite de registros de 0 o 1
	$sql = "SELECT 
	*
	FROM carac_doc ORDER BY id desc limit 0,1";
	//ejecucion de consulta SQL
	$query = $mysqli->query($sql) or die($mysqli->error);
	//desgloce de la data
	$result = $query->fetch_array();
	//echo $result['Descripcion'];
	//codificacion e impresion del json
	//---------------------------------------
	$sql = "SELECT count(id) FROM carac_doc where id < ".$result['id'];
	$query = $mysqli->query($sql);
	$num =$query->fetch_array();
	$num = $num[0]+1;
	//----------------------------------------
	$data = array(
		"Number" 				=> $num,
		"id" 			=> $result['id'],
		"CodPdvsa" 		=> $result['codpdvsa'],
		"fase" 			=> $result['fase'],
		"status" 		=> $result['status'],
		"actividad" 	=> $result['actividad'],
		"disciplina" 	=> $result['disciplina'],
		"instalacion" 	=> utf8_encode($result['instalacion']),
		"docPlano" 	=> $result['doc_plano'],
		"digitalFisico"=> $result['digital_fisico']);
	echo json_encode($data);
 ?>