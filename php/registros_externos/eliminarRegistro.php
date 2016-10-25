<?php 
include ("../../conexion/conexion.php");
$codigo = $_POST['codcliente'];
//consulta para eliminar
$sql = "DELETE FROM registros_externos WHERE codcliente ='$codigo'";
//array para returnar
$data = array('Success' => false, 'Msg' => '' );
//si la consulta se ejecuta
if ($mysqli->query($sql)) {
	$data['Success'] = true;
	$data['Msg'] = 'Registro eliminado con exito';
	}
else{
	$data['Success'] = false;
	$data['Msg'] = 'Registro imposible de eliminar. '.$mysqli->error;
	}
echo json_encode($data);
?>