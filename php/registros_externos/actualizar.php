<?php 
ini_set('display_errors', 1);
include('../../conexion/conexion.php');

$id = $_POST['id'];
$codCliente = $_POST['codcliente'];
$descripcion = $_POST['descripcion'];
$rev = $_POST['rev'];
$fecha = isset($_POST['fecha']) ? $_POST['fecha'] : '';
$disciplina = $_POST['disciplina'];
$fase = $_POST['fase'];

$fecha = new DateTime($fecha);
$fecha = $fecha->format('Y-m-d');
$sql="UPDATE
  registros_externos
SET
  descripcion = '$descripcion',
  rev = '$rev',
  fecha_rev = '$fecha',
  codCliente = '$codCliente',
  disciplina = '$disciplina',
  fase = '$fase'
WHERE
  id = '$id'";
$data = array('Success' => false , 'Msg' => '', 'Error' => '' );
if ($mysqli->query($sql)) {
	$data['Success'] = true;
	$data['Msg'] = 'Registro Actualizado';
}
else{
	$data['Msg'] = 'Error al actualizar';
	$data['Error'] = $mysqli->error; 
}
echo json_encode($data);
 ?>
