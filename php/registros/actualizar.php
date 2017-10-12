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
	fecha_rev = '$fecha',
	disciplina = '$disciplina'
	WHERE id = '$id'";

$data = array('Success' => false, 'Msg' => '', 'Campo' => '' );
if (!empty($codPdvsa) && isset($codPdvsa)) {
  if (!empty($rev) && isset($rev)) {
    if (strlen($descripcion) > 0) {
    	if ($mysqli->query($sql)) {
			$data['Success'] = true;
			$data['Msg'] = 'Registro actualizado';
		}
		else{
			$data['Msg'] = 'No se pudo actualizar el registro. '.$mysqli->error;
			}
    	}
    else{
    	$data['Msg'] = "Descripcion es requerido";
      	$data['Campo'] = 'descripcion';
    	}
    }
    else{
	    $data['Msg'] = "Revision es requerido";
	    $data['Campo'] = 'rev';
	  }
}
else{
  $data['Msg'] = "codPdvsa es requerido";
  $data['Campo'] = 'codPdvsa';
}


echo json_encode($data);
 ?>