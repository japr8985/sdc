<?php 
include("../../conexion/conexion.php");
ini_set('display_errors', 1);
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
//conteo de filas
$filas = $listas->num_rows;
//en caso de que la lista este vacia retorna un 0
if (is_null($data)) {
  $data = 0;
}
echo json_encode(array($data,$filas));
 ?>