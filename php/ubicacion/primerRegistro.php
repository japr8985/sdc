<?php 
//incluir archivo de conexion
include ("../../conexion/conexion.php");
//consulta para obtener el primer registro
$sql = "SELECT * FROM ubicacion ORDER BY id ASC LIMIT 0,1";
//ejecucion de la consulta
$query = $mysqli->query($sql) or die($mysqli->error);
//desgloce de la data
$result = $query->fetch_array();
//---------------------------------
$sql = "SELECT count(id) FROM ubicacion WHERE id < ".$result['id'];
$query = $mysqli->query($sql) or die($mysqli->error);
$num = $query->fetch_array();
$num = $num[0]+1;
//---------------------------------
//arreglo a enviar
$data = array(
	"Number" 				=> $num,
	'id' 						=> $result['id'],
	'ciudad' 				=> $result['ciudad'],
	'sede' 					=> $result['sede'],
	'departamento' 	=> $result['dpto'],
	'nProyecto' 		=> $result['nproyecto'],
	'year' 					=> $result['year'],
	'nCaja' 				=> $result['ncaja'],
	'codCarpeta' 		=> $result['codcarprinc'],
	'subCarpeta' 		=> $result['codsubcarp'],
	'nDoc' 					=> $result['ndoc'],
	'codPdvsa' 			=> $result['codpdvsa'],
	'fase' 					=> $result['fase'],
	'rev' 					=> $result['rev']);
//codificacion e impresion del json
echo json_encode($data);
 ?>