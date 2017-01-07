<?php 
include('../../conexion/conexion.php');
$id = $_POST['id'];
$codPdvsa = $_POST['codPdvsa'];
$fase = $_POST['fase'];
$status = $_POST['status'];
$actividad = $_POST['actividad'];
$disciplina = $_POST['disciplina'];
$instalacion = $_POST['instalacion'];
$docPlano = $_POST['docPlano'];
$digitalFisico = $_POST['digitalFisico'];
$sql = "UPDATE
  carac_doc
SET
  disciplina = '$disciplina',
  fase = '$fase',
  status = '$status',
  actividad = '$actividad',
  instalacion = '$instalacion',
  codpdvsa = '$codPdvsa',
  doc_plano = '$docPlano',
  digital_fisico = '$digitalFisico'
WHERE
  id = '$id'";
$data = array('Success' => fale , 'Msg' => '','Error' => '' );
if ($mysqli->query($data)) {
	$data['Success'] = true;
	$data['Msg'] = 'Registro actualizado';
}
else{
	$data['Msg'] = 'Error al registrar';
	$data['Error'] = $mysqli->error;
}
echo json_encode($data);
 ?>
