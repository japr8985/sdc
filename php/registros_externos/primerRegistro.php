<?php 
	include('../../conexion/conexion.php');
	$sql = "SELECT * FROM registros_externos ORDER BY id ASC LIMIT 0,1";
	$query = $mysqli->query($sql) or die($mysqli->error);
	//desgloce de la data
	$result = $query->fetch_array();
	//var_dump($result);
	$data = array(
		'id' 					=> $result['id'],
		'codCliente'	=> $result['codCliente'],
		'descripcion' => $result['descripcion'],
		'rev' 				=> $result['rev'],
		'fecha' 			=> $result['fecha_rev'],
		'disciplina' 	=> $result['disciplina'],
		'fase' 				=> $result['fase']);
	echo json_encode($data);
 ?>