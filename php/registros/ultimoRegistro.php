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
	$sql = "SELECT count(id) FROM registros_total where id < ".$result['ID'];
	$num = $mysqli->query($sql);
	$num = $num->fetch_array();
	$num = $num[0]+1;
	//--------------------------------------------
	$fecha = new DateTime($result['Fecha_Rev']);
	$fecha = $fecha->format('Y-m-d');
	$data = array(
		"ID" 			=> $result['ID'],
		"CodPdvsa" 		=> $result['CodPdvsa'],
		"Descripcion" 	=> utf8_encode($result['Descripcion']),
		"Rev" 			=> $result['Rev'],
		"fecha" 	=> $fecha,
		"CodCliente" 	=> $result['CodCliente'],
		"Disciplina" 	=> $result['Disciplina'],
		"Status" 		=> $result['Status'],
		"Fase" 			=> $result['Fase'],
		"Number"  => $num);
	echo json_encode($data);
 ?>