<?php 
	include('../../conexion/conexion.php');
	$sql = "SELECT  registros_externos.*, disciplina.simbolo as disciplina from registros_externos, disciplina where  disciplina.Disciplina = registros_externos.Disciplina ORDER BY id ASC LIMIT 0,1";
	$query = $mysqli->query($sql) or die($mysqli->error);
	//desgloce de la data
	$result = $query->fetch_array();
	//var_dump($result);
	//---------------------------------------
	$sql = "SELECT count(id) FROM registros_externos where id < ".$result['id'];
	$query = $mysqli->query($sql);
	$num =$query->fetch_array();
	$num = $num[0]+1;
	//----------------------------------------
	$data = array(
		'Number' => $num,
		'id' 					=> $result['id'],
		'codCliente'	=> $result['codCliente'],
		'descripcion' => $result['descripcion'],
		'rev' 				=> $result['rev'],
		'fecha' 			=> $result['fecha_rev'],
		'disciplina' 	=> $result['disciplina'],
		'fase' 				=> $result['fase']);
	echo json_encode($data);
 ?>