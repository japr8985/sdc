<?php 
include ("../../conexion/conexion.php");
$codigo = $_POST['codpdvsa'];
$id = $_POST['id'];
//consulta para eliminar
$sql = "DELETE FROM registros_total WHERE codpdvsa ='$codigo' and id='$id'";
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