<?php 
	include ("../../conexion/conexion.php");
	//capturando el valor enviado
	$cod = $_REQUEST['data'];
	//consulta
	$sql = "SELECT * from ubicacion where codpdvsa = '$cod' limit 0,1";
	//variable de verificacion
	$success = false;
	$error ='';
	//ejecucion de la consulta
	if ($query = $mysqli->query($sql)) {
		
		if($query->num_rows == 1)//si consigue 1 registro
			$success = true;
		else{//si no consiguio nada
			$error = "No se ha encontrado el registro";
			}
		}
	else{
		$error = $mysqli->error;
	} 
	
	//desgloce de la data
	$result = $query->fetch_array();
	
	//cantidad de codigos repetidos 
	$sql = "SELECT count(id) FROM ubicacion WHERE codpdvsa = '$cod'";
	$query = $mysqli->query($sql) or die($sql);
	$coinc = $query->fetch_array();
	//listado de codigos repetidos
	$sql = "SELECT * FROM ubicacion WHERE codpdvsa = '$cod'";
	$query = $mysqli->query($sql);
	$repetido_array= [];
	while ($data = $query->fetch_array()) {
		$repetido_array[] = $data;
	}

	$data = array(
		'Success'			=> $success,
		'id' 					=> $result['id'],
		'ciudad' 			=> $result['ciudad'],
		'sede' 				=> $result['sede'],
		'departamento'=> $result['dpto'],
		'nProyecto' 	=> $result['nproyecto'],
		'year' 				=> $result['year'],
		'nCaja' 			=> $result['ncaja'],
		'codCarpeta' 	=> $result['codcarprinc'],
		'subCarpeta' 	=> $result['codsubcarp'],
		'nDoc' 				=> $result['ndoc'],
		'codPdvsa' 		=> $result['codpdvsa'],
		'fase' 				=> $result['fase'],
		'rev' 				=> $result['rev'],
		'error'				=> $error,
		"Coincidencia"	=> intval($coinc[0]),
		"Data" 			=> $repetido_array);
	echo json_encode($data);
 ?>