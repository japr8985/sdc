<?php 
include ("../../conexion/conexion.php");
ini_set('display_errors', 1);

//variables enviadas desde el formulario
$codPdvsa 	= $_POST['codPdvsa'];
$descripcion= $_POST['descripcion'];
$rev 		= isset($_POST['rev']) ? strtoupper($_POST['rev']) : 'A';
$disciplina = $_POST['disciplina'];
$fase 		= $_POST['fase'];
$codCliente = $_POST['codCliente'];
$fecha 		= isset($_POST['fecha']) ? new DateTime($_POST['fecha']) : new DateTime();
$fecha 		= $fecha->format('Y-m-d');
//arreglo de resupesta donde se enviaran los resultados
//de las validaciones y si la data es guardada correctamente
$data = array('Success' => false,'Msg' => '', 'Error' => '');

//busca el/los registro(s) con el mismo codigo pdvsa
$sql = "SELECT id from registros_total WHERE codpdvsa = '$codPdvsa' ";
$query = $mysqli->query($sql);
$num_rows = $query->num_rows;
if ($num_rows > 0) {//si existe mas de un registro
  //busca el registro mas reciente y selecciona su revision
  $sql = "SELECT rev from registros_total WHERE codpdvsa = '$codPdvsa' ORDER BY fecha_rev ASC Limit 0,1";
  $result = $mysqli->query($sql);
  $rev_old = $result->fetch_array();
  //valida si la nueva revision es mayor que la vieja
  if (revValor($rev) > revValor($rev_old[0])) {//procede a guardar
    //actualiza todos los registros anteriores a superado
    $sql = "UPDATE registros_total SET status = 'SUPERADO' WHERE codpdvsa = '$codPdvsa'";
    $mysqli->query($sql);
    //guardar el nuevo registro
    $sql = "INSERT INTO
                registros_total(
                    codpdvsa,
                    descripcion,
                    rev,
                    fecha_rev,
                    codcliente,
                    disciplina,
                    status,
                    fases
                )
                VALUES('$codPdvsa', '$descripcion', '$rev', '$fecha','$codCliente', '$disciplina', 'ACTIVO','$fase')";
    if ($mysqli->query($sql)) {
      $data['Success'] = true;
      $data['Msg'] = "Registro guardado exitosamente";
      } 
    else {
      $data['Msg'] = "Fallo al registar.";
      $data['Error'] = $mysqli->error;
      }
  }
  else{
    $data['Msg'] = "Fallo al registar.";
      $data['Error'] = "Intenta ingresar una revision menor a una ya existente";
  }
}
else{
  $sql = sprintf("INSERT INTO
   registros_total(
    codpdvsa,
    descripcion,
    rev,
    fecha_rev,
    codcliente,
    disciplina,
    status,
    fases
  )
VALUES('%s', '%s', '%s', '$fecha','%s', '%s', 'ACTIVO','%s')",
$mysqli->real_escape_string($codPdvsa),
$mysqli->real_escape_string($descripcion),
$mysqli->real_escape_string($rev),
$mysqli->real_escape_string($codCliente),
$mysqli->real_escape_string($disciplina),
$mysqli->real_escape_string($fase));
  if ($mysqli->query($sql)) {
    $data['Success'] = true;
    $data['Msg']= "Registro ingresado con exito";
  } else {
    $data['Msg'] = "Error al registrar. ".$mysqli->error;
  }
}

echo json_encode($data);
 ?>