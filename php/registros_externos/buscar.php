<?php 
ini_set('display_errors', 1);
	include ("../../conexion/conexion.php");
	//capturando el valor enviado
	$cod = $_REQUEST['data'];
	//consulta
	$sql = "SELECT * from registros_externos where codCliente = '$cod' limit 0,1";

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

	
	//cantidad de codigos repetidos 
	$sql = "SELECT count(id) FROM registros_externos WHERE codCliente = '$cod'";
	$query = $mysqli->query($sql) or die($sql);
	$coinc = $query->fetch_array();
	//listado de codigos repetidos
	$sql = "SELECT * FROM registros_externos WHERE codCliente = '$cod'";
	$query = $mysqli->query($sql);
	$repetido_array= [];
	while ($data = $query->fetch_array()) {
		$repetido_array[] = $data;
	}

	$data = array(
		'id' 					=> $result['id'],
		'codCliente'	=> $result['codCliente'],
		'descripcion' => utf8_encode($result['descripcion']),
		'rev' 				=> $result['rev'],
		'fecha' 			=> $fecha,
		'disciplina' 	=> $result['disciplina'],
		'fase' 				=> $result['fase'],
		"Coincidencia"	=> intval($coinc[0]),
		"Data" 			=> $repetido_array);
	echo json_encode($data);
 ?>