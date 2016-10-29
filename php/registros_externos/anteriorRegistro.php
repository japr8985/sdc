<?php 
	include ("../../conexion/conexion.php");
	$id = $_REQUEST['id'];
	$sql = "SELECT registros_externos.*, disciplina.simbolo AS disciplina
	FROM registros_externos, disciplina
	WHERE id = (SELECT max(id) FROM registros_externos WHERE id < $id) and disciplina.Disciplina = registros_externos.Disciplina";
	//ejecucion de consulta SQL
	$query = $mysqli->query($sql) or die($mysqli->error);
	//desgloce de la data
	$result = $query->fetch_array();
	//echo $result['Descripcion'];
	//codificacion e impresion del json
	//---------------------------------------
	$sql = "SELECT count(id) FROM registros_externos where id < ".$result['id'];
	$query = $mysqli->query($sql);
	$num =$query->fetch_array();
	$num = $num[0]+1;
	//----------------------------------------
	$data = array(
		"Number" 			=> $num,
		'id' 					=> $result['id'],
		'codCliente'	=> $result['codCliente'],
		'descripcion' => utf8_encode($result['descripcion']),
		'rev' 				=> $result['rev'],
		'fecha' 			=> $result['fecha_rev'],
		'disciplina' 	=> $result['disciplina'],
		'fase' 				=> $result['fase']);
	echo json_encode($data);
 ?>