<?php 
	include ("../../conexion/conexion.php");
	$id = $_REQUEST['id'];
	$sql = "SELECT * FROM registros_externos WHERE id = (SELECT min(id) FROM ubicacion where id > $id)";
	//ejecucion de consulta SQL
	$query = $mysqli->query($sql) or die($mysqli->error);
	//desgloce de la data
	$result = $query->fetch_array();
	//echo $result['Descripcion'];
	//codificacion e impresion del json
	$data = array(
		'id' 					=> $result['id'],
		'codCliente'	=> $result['codCliente'],
		'descripcion' => utf8_encode($result['descripcion']),
		'rev' 				=> $result['rev'],
		'fecha' 			=> $result['fecha_rev'],
		'disciplina' 	=> $result['disciplina'],
		'fase' 				=> $result['fase']);
	echo json_encode($data);
 ?>