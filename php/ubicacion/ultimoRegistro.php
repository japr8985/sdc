<?php 
	//inlcuir el archivo de conexion
	include('../../conexion/conexion.php');
	//consulta SQL -> selecciona todo de registros_total ordenados por el id de manera desc (del mayor al menor)
	//con un limite de registros de 0 o 1
	$sql = "SELECT * FROM ubicacion ORDER BY id desc limit 0,1";
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
	//echo $result['Descripcion'];
	//codificacion e impresion del json
	$data = array(
		"Number"			=> $num,
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