<?php 
	include ("../../conexion/conexion.php");
	//capturando el valor enviado
	$cod = $_REQUEST['data'];
	//consulta
	$sql = "SELECT *  
FROM
  carac_doc
WHERE
  codpdvsa LIKE '%$cod%' 
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
		"error" 		=> $error);
	//imprimiendo json
	echo json_encode($data);
 ?>