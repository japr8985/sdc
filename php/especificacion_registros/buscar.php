<?php 
	include ("../../conexion/conexion.php");
	//capturando el valor enviado
	$cod = $_REQUEST['data'];
	//consulta
	$sql = "SELECT *  
FROM
  carac_doc
WHERE
  codpdvsa = '$cod' 
ORDER BY id ASC
LIMIT 0, 1";
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
	$sql = "SELECT count(id) FROM carac_doc WHERE codpdvsa = '$cod'";
	$query = $mysqli->query($sql);
	$coinc = $query->fetch_array();
	//listado de codigos repetidos
	$sql = "SELECT * FROM carac_doc WHERE codpdvsa = '$cod'";
	$query = $mysqli->query($sql);
	$repetido_array= [];
	while ($data = $query->fetch_array()) {
		$repetido_array[] = $data;
	}

	//armando arreglo
	$data = array(
		'Success' 		=> $success,
		"id" 			=> $result['id'],
		"CodPdvsa" 		=> $result['codpdvsa'],
		"fase" 			=> $result['fase'],
		"status" 		=> $result['status'],
		"actividad" 	=> $result['actividad'],
		"disciplina" 	=> $result['disciplina'],
		"instalacion" 	=> utf8_encode($result['instalacion']),
		"docPlano" 	=> $result['doc_plano'],
		"digitalFisico"=> $result['digital_fisico'],
		"error" 		=> $error,
		"Coincidencia"	=> intval($coinc[0]),
		"Data" 			=> $repetido_array);
	//imprimiendo json
	echo json_encode($data);
 ?>