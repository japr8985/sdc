<?php 
ini_set('display_errors', 1);
	include ("../../conexion/conexion.php");
	$id = $_REQUEST['id'];
	$sql = "SELECT  * from registros_externos where  id = (SELECT min(id) FROM registros_externos where id > $id)";

	$data = array(
		'Number' => '',
		'id' 					=> $id,
		'codCliente'	=> '',
		'descripcion' => '',
		'rev' 				=> '',
		'fecha' 			=> '',
		'disciplina' 	=> '',
		'fase' 				=> '');
	//ejecucion de consulta SQL
	if($query = $mysqli->query($sql)){
		//desgloce de la data
		$result = $query->fetch_array();
		///---------------------------------------
		$sql = "SELECT count(id) FROM registros_externos where id < ".$result['id'];
		if($query = $mysqli->query($sql)){
			$num =$query->fetch_array();
			$num = $num[0]+1;
			//----------------------------------------
			if (!is_null($result['fecha_rev'])) {
					$fecha = new DateTime($result['fecha_rev']);
					$fecha = $fecha->format('Y-m-d');
				}
			else
					$fecha = null;
			$data = array(
				'Number' => $num,
				'id' 					=> $result['id'],
				'codCliente'	=> $result['codCliente'],
				'descripcion' => utf8_encode($result['descripcion']),
				'rev' 				=> $result['rev'],
				'fecha' 			=> $fecha,
				'disciplina' 	=> $result['disciplina'],
				'fase' 				=> $result['fase']);
		}
		
	}

	echo json_encode($data);
 ?>