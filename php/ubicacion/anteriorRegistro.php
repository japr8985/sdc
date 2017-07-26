<?php 
	include ("../../conexion/conexion.php");
	
	$id = ($_POST['id'] == '' || intval($_POST['id']) < 2) ? 2 : $_POST['id'];
	$sql = "SELECT * FROM ubicacion WHERE id = (SELECT max(id) FROM ubicacion WHERE id < ".$id.")";
	//ejecucion de consulta SQL
	$query = $mysqli->query($sql) or die($mysqli->error);
	//desgloce de la data
	$result = $query->fetch_array();
	//---------------------------------
	$sql = "SELECT count(id) FROM ubicacion WHERE id < ".$result['id'];
	$query = $mysqli->query($sql) or die($mysqli->error);
	$num = $query->fetch_array();
	$num = $num[0]+1;
	//---------------------------------
	//codificacion e impresion del json
	$data = array(
		'Number' 			=> $num,
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