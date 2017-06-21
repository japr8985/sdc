<?php 
include ("../../conexion/conexion.php");
ini_set('display_errors', 1);
$id = $_POST['id'];
$sql = "SELECT * FROM registros_total 
	WHERE id = (SELECT min(id) FROM registros_total where id > $id) 
	and codpdvsa =";
//ejecucion de consulta SQL
$query = $mysqli->query($sql) or die($mysqli->error);
if ($query->num_rows > 0) {
	//desgloce de la data
	$result = $query->fetch_array();
	//----------------------------------------
	$sql = "SELECT count(id) FROM registros_total where id < ".$result['id'];
	$query = $mysqli->query($sql);
	$num = $query->fetch_array();
	$num = $num[0]+1;
	//----------------------------------------
	//Formateando fecha para poder ser visualizada
	if (is_null($result['fecha_rev'])) {
		$fecha = null;
	} else {
		$fecha = new DateTime($result['fecha_rev']);
		$fecha = $fecha->format('Y-m-d');
	}
	//-----------------------------------------
	//codificacion del json
	$data = array(
	"Number"		=> $num,
	"ID" 			=> $result['id'],
	"CodPdvsa" 		=> $result['codpdvsa'],
	"Descripcion" 	=> utf8_encode($result['descripcion']),
	"Rev" 			=> $result['rev'],
	"fecha" 		=> $fecha,
	"CodCliente" 	=> $result['codcliente'],
	"Disciplina" 	=> $result['disciplina'],
	"Status" 		=> $result['status'],
	"Fase" 			=> $result['fases']);
	//impresion del json
	echo json_encode($data);


	

}
else {
	# code...
}


 ?>