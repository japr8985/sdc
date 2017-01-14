<?php 
include("../../conexion/conexion.php");

$sql = "SELECT 
  id,
  codpdvsa,
  descripcion,
  rev,
  fecha_rev as fecha,
  codcliente as CodCliente,
  status,
  disciplina,
  fases
  FROM registros_total
  WHERE
 status ='ACTIVO'";
$listas = $mysqli->query($sql) or die($mysqli->error);

while ($l = $listas->fetch_array()) {
	$fecha = (!is_null($l['fecha'])) ? new DateTime($l['fecha']) : null ;
  if(!is_null($fecha))
    $fecha = $fecha->format('Y-m-d');
	$data[] = array(
    $l['id'],
    utf8_encode($l['codpdvsa']),
    utf8_encode($l['descripcion']),
		utf8_encode($l['rev']),
		$l['fases'],
    $l['disciplina'],
    $fecha,
    $l['status'],
  );
}
//var_dump($data);
echo json_encode($data);
 ?>