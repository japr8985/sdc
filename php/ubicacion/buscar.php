<?php 
	include ("../../conexion/conexion.php");
	//capturando el valor enviado
	$cod = $_REQUEST['data'];
	//consulta
	$sql = "SELECT * from registros_total where codpdvsa like '%$cod%' limit 0,1";
	//ejecucion de la consulta
	$query = $mysqli->query($sql);
	//desgloce de la data
	$result = $query->fetch_array();
	
	$data = array(
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
		'rev' 				=> $result['rev']);
	echo json_encode($data);
 ?>