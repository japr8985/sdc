<?php 
	include ("../../conexion/conexion.php");
	//capturando el valor enviado
	$cod = $_REQUEST['data'];
	//consulta
	$sql = "SELECT * from ubicacion where codpdvsa like '%$cod%' ORDER BY id ASC limit 0,1";
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
		'error'				=> $error);
	echo json_encode($data);
 ?>