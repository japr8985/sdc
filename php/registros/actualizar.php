<?php 
include ("../../conexion/conexion.php");
$codPdvsa 	= $_POST['codPdvsa'];
$descripcion= $_POST['descripcion'];
$rev 		= isset($_POST['rev']) ? $_POST['rev'] : 'A';
$disciplina = $_POST['disciplina'];
$fase 		= $_POST['fase'];
$codCliente = $_POST['codCliente'];
$fecha 		= isset($_POST['fecha']) ? new DateTime($_POST['fecha']) : new DateTime();
$fecha 		= $fecha->format('Y-m-d');
$id 		= $_POST['id'];

$sql = "UPDATE registros_total SET 
	codpdvsa = '$codPdvsa',
	descripcion = '$descripcion',
	rev = '$rev',
	fases = '$fase',
	codcliente = '$codCliente',
	fecha_rev = '$fecha'
	WHERE id = '$id'";
$data = array('Success' => false, 'Msg' => '' );
if ($mysqli->query($sql)) {
	$data['Success'] = true;
	$data['Msg'] = 'Registro actualizado';
}
else{
	$data['Msg'] = 'No se pudo actualizar el registro. '.$mysqli->error;
}

echo json_encode($data);
 ?>