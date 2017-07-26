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
$data = array('Success' => false , 'Msg' => '','Error' => '' );

if (!empty($codpdvsa)) {
  if (!empty($status)) {
    if ($mysqli->query($sql)) {
      $data['Success'] = true;
      $data['Msg'] = 'Registro actualizado';
    }
    else{
      $data['Msg'] = 'Error al registrar';
      $data['Error'] = $mysqli->error;
    }
  }
  else{
    $data['Error'] = "Status es requerido";
    $data['Campo'] = 'status';
  }
}
else{
  $data['Error'] = "Cod. PDVSA es requerido";
  $data['Campo'] = 'codPdvsa';
}

echo json_encode($data);
 ?>
