<?php 
ini_set('display_errors', 1);
include('../../conexion/conexion.php');
$id 					= $_POST['id'];
$ciudad 			= $_POST['ciudad'];
$sede 				= $_POST['sede'];
$departamento = $_POST['departamento'];
$nproyecto 		= $_POST['np'];
$year 				= $_POST['year'];
$ncaja 				= $_POST['ncaja'];
$codcarpeta 	= $_POST['carpeta'];
$subcarpeta 	= $_POST['sub'];
$ndoc 				= $_POST['ndoc'];
$codpdvsa 		= $_POST['codpdvsa'];
$fase 				= $_POST['fase'];
$rev 					= $_POST['rev'];

$sql = "UPDATE 
	ubicacion
	SET 
		ciudad = '$ciudad',
		sede = '$sede',
		dpto = '$departamento',
		nproyecto = '$nproyecto',
		year = '$year',
		ncaja = '$ncaja',
		codcarprinc ='$codcarpeta',
		codsubcarp = '$subcarpeta',
		ndoc ='$ndoc',
		codpdvsa ='$codpdvsa',
		fase ='$fase',
		rev = '$rev'
	WHERE 
			id = '$id'";
$data = array('Success' => false, 'Msg' => '', 'Error' =>'');
if ($mysqli->query($sql)) {
	$data['Success'] = true;
	$data['Msg'] = 'Registro actualizado exitosamente';
}
else{
	$data['Msg'] = 'Error al actualziar';
	$data['Error'] = $mysqli->error;
}
echo json_encode($data);

 ?>