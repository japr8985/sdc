<?php 
	include ("../../conexion/conexion.php");
	//capturando el valor enviado
	$cod = $_REQUEST['data'];
	//consulta
	$sql = "SELECT registros_externos.*, disciplina.simbolo as disciplina from registros_externos, disciplina where codCliente like '%$cod%' and disciplina.Disciplina = registros_externos.Disciplina limit 0,1";
	//ejecucion de la consulta
	$query = $mysqli->query($sql);
	//desgloce de la data
	$result = $query->fetch_array();
	//var_dump($result);
		if (!is_null($result['fecha_rev'])) {
			$fecha = new DateTime($result['fecha_rev']);
			$fecha = $fecha->format('Y-m-d');
		}
		else
			$fecha = null;
	$data = array(
		'id' 					=> $result['id'],
		'codCliente'	=> $result['codCliente'],
		'descripcion' => utf8_encode($result['descripcion']),
		'rev' 				=> $result['rev'],
		'fecha' 			=> $fecha,
		'disciplina' 	=> $result['disciplina'],
		'fase' 				=> $result['fase']);
	echo json_encode($data);
 ?>