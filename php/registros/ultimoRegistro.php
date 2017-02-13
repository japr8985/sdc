<?php 
	//inlcuir el archivo de conexion
	include('../../conexion/conexion.php');
	//consulta SQL -> selecciona todo de registros_total ordenados por el id de manera desc (del mayor al menor)
	//con un limite de registros de 0 o 1
	$sql = "SELECT * FROM registros_total ORDER BY id desc limit 0,1";
	//ejecucion de consulta SQL
	$query = $mysqli->query($sql) or die($mysqli->error);
	//desgloce de la data
	$result = $query->fetch_array();
	//--------------------------------------------
	$sql = "SELECT count(id) FROM registros_total where id < ".$result['id'];
	$query = $mysqli->query($sql);
	$num = $query->fetch_array();
	$num = $num[0]+1;
	//--------------------------------------------
	$fecha = new DateTime($result['fecha_rev']);
	$fecha = $fecha->format('Y-m-d');
	$data = array(
		"Number"		=> $num,
		"ID" 			=> $result['id'],
		"CodPdvsa" 		=> $result['codpdvsa'],
		"Descripcion" 	=> utf8_encode($result['descripcion']),
		"Rev" 			=> $result['rev'],
		"Fecha_Rev" 	=> $result['fecha_rev'],
		"CodCliente" 	=> $result['codcliente'],
		"Disciplina" 	=> $result['disciplina'],
		"Status" 		=> $result['status'],
		"Fase" 			=> $result['fases']);
	echo json_encode($data);
 ?>