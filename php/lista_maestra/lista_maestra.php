<?php 
include("../../conexion/conexion.php");
/*$sql = "SELECT
  ID as id,
  CodPdvsa as codpdvsa,
  Descripcion as descripcion,
  Rev as rev,
  Fecha_Rev as fecha,
  CodCliente as CodCliente,
  disciplina.simbolo AS disciplina,
  Status as status,
  Fase as fase
FROM
  lista_maestra,
  disciplina
WHERE
  lista_maestra.Disciplina = disciplina.Disciplina
  ORDER BY id ASC 
";*/
$sql = "SELECT 
  DISTINCT(codpdvsa),
  descripcion,
  rev,
  fecha_rev as rev,
  codcliente as CodCliente,
  disciplina.simbolo as disciplina,
  status,
  fase
  FROM registros_total, disciplina
  WHERE
    lista_maestra.Disciplina = disciplina.Disciplina
    and status ='ACTIVO'";
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
		$l['fase'],
    $l['disciplina'],
    $fecha,
    $l['status'],
  );
}
//var_dump($data);
echo json_encode($data);
 ?>