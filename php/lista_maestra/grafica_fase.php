<?php 
include("../../conexion/conexion.php");
ini_set('display_errors', 1);


$sql = "SELECT 
		count(registros_total.id) as num, 
		fases.fase as fase 
	FROM registros_total, fases 
	WHERE 
		fases.codigo = registros_total.fases 
	GROUP BY 
		registros_total.fases";
$query = $mysqli->query($sql);

$result = [];

while ($r = $query->fetch_array()) {
	$result[] = ['name' => $r['fase'], 'y' => intval($r['num'])];
}

echo json_encode($result);
 ?>