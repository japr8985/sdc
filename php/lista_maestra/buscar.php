<?php 
include("../../conexion/conexion.php");
ini_set('display_errors', 1);
//verifica envio de informacion por post
$cod = $_POST['codigo'];
//hace la busqueda de lo enviado por post donde solo se selecciona el id y se limita a 1 resultado
//$sql = "SELECT id FROM registros_total WHERE codpdvsa = '$cod' Limit 0,1";
$sql = "SELECT
  registros_total.codpdvsa,
  registros_total.rev,
  registros_total.fecha_rev as fecha,
  registros_total.descripcion,
  registros_total.codcliente,
  registros_total.status,
  fases.fase,
  disciplina.disciplina
FROM
  `registros_total`,
  fases,
  disciplina
WHERE
  `codpdvsa` = '$cod' AND registros_total.fases = fases.codigo AND registros_total.status = 'ACTIVO' and registros_total.disciplina = disciplina.simbolo
ORDER BY
  `codpdvsa` ASC";

//ejecucion de query
$query = $mysqli->query($sql) or die($mysqli->error);
if($query->num_rows > 0){
    $data = array(
    	'cantidad' => $query->num_rows,
    	'registros' => []
    	);
    while ($reg = $query->fetch_array()) {
    	$data['registros'][] = [
    		"codpdvsa" => $reg['codpdvsa'],
    		"descripcion" => $reg['descripcion'],
    		"rev" => $reg['rev'],
    		"fecha" => date('Y-m-d',strtotime($reg['fecha'])),
    		"codCliente" => $reg['codcliente'],
    		"status" => $reg['status'],
    		"fase" => $reg['fase'],
    		"disciplina" => $reg['disciplina'],
    	];
    }

}
else{
    $data = array(
    	'cantidad' => $query->num_rows,
    	'registros' => null
    	);
}
//envio del ID encontrado
echo json_encode($data);
 ?>