<?php 
include("../../conexion/conexion.php");
$data = array("Success" => false, "Msg" => '', "Error" => '');
$sql = "UPDATE registros_total SET status='SUPERADO' where status = 'ACTIVO'";
if ($mysqli->query($sql))
	$data['Success'] = true;
else{
	$data['Msg'] = "Error al actualizar:";
	$data['Error'] = $mysqli->error;
}
echo json_encode($data);
 ?>
