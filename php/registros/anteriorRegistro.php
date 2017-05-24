<?php 
	include ("../../conexion/conexion.php");
	$id = $_REQUEST['id'];
	$sql = "SELECT * FROM registros_total WHERE id = (SELECT max(id) FROM registros_total WHERE id < $id) ";
	//ejecucion de consulta SQL
	$query = $mysqli->query($sql) or die($mysqli->error);
	//si tiene al menos una fila
	if ($query->num_rows > 0) {
		//desgloce de la data
	$result = $query->fetch_array();
	//echo $result['Descripcion'];
	//----------------------------------------
	$sql = "SELECT count(id) FROM registros_total where id < ".$result['id'];
	$query = $mysqli->query($sql);
	$num = $query->fetch_array();
	$num = $num[0]+1;
	
	//----------------------------------------
	//Formateando fecha para poder ser visualizada
	$fecha = new DateTime($result['fecha_rev']);
	$fecha = $fecha->format('Y-m-d');
	//-----------------------------------------
	//codificacion e impresion del json
	$data = array(
		"Number"		=> $num,
		"ID" 			=> $result['id'],
		"CodPdvsa" 		=> $result['codpdvsa'],
		"Descripcion" 	=> utf8_encode($result['descripcion']),
		"Rev" 			=> $result['rev'],
		"fecha"		 	=> $fecha,
		"CodCliente" 	=> $result['codcliente'],
		"Disciplina" 	=> $result['disciplina'],
		"Status" 		=> $result['status'],
		"Fase" 			=> $result['fases']);
	echo json_encode($data);
	} else {
		$mysqli->error;
	}
	
	
 ?>