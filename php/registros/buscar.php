<?php 
ini_set('display_errors', 1);
	include ("../../conexion/conexion.php");
	//capturando el valor enviado
	$cod = $_REQUEST['data'];
	//consulta
	$sql = "SELECT * from registros_total where codpdvsa = '$cod' ORDER BY id ASC limit 0,1";
	//ejecucion de la consulta
	$query = $mysqli->query($sql);
	//desgloce de la data
	$result = $query->fetch_array();
	//----------------------------------------
	$sql = "SELECT id FROM registros_total where id < ".$result['id'];
	$query = $mysqli->query($sql);
	if ($query) {
		$num = $query->num_rows;
		$num = $num[0]+1;
		//----------------------------------------

		if (is_null($result['fecha_rev'])) {
			$fecha = null;
		} else {
			$fecha = new DateTime($result['fecha_rev']);
			$fecha = $fecha->format('Y-m-d');
		}
		$data = array(
		"Number"		=> $num,
		"ID" 			=> $result['id'],
		"CodPdvsa" 		=> $result['codpdvsa'],
		"Descripcion" 	=> utf8_encode($result['descripcion']),
		"Rev" 			=> $result['rev'],
		"Fecha_Rev" 	=> $fecha,
		"CodCliente" 	=> $result['codcliente'],
		"Disciplina" 	=> $result['disciplina'],
		"Status" 		=> $result['status'],
		"Fase" 			=> $result['fases']);
		echo json_encode($data);
	}
	else{
		$data= array(
			"Number"		=> '',
			"ID" 			=> '',
			"CodPdvsa" 		=> '',
			"Descripcion" 	=> '',
			"Rev" 			=> '',
			"Fecha_Rev" 	=> '',
			"CodCliente" 	=> '',
			"Disciplina" 	=> '',
			"Status" 		=> '',
			"Fase" 			=> ''
			);
		echo json_encode($data);
	}
	
	
	
 ?>