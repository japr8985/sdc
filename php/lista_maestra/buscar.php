<?php 
include("../../conexion/conexion.php");
ini_set('display_errors', 1);
//verifica envio de informacion por post
$cod = $_POST['codigo'];
//hace la busqueda de lo enviado por post donde solo se selecciona el id y se limita a 1 resultado
$sql = "SELECT id FROM registros_total WHERE codpdvsa = '$cod' Limit 0,1";
//ejecucion de query
$query = $mysqli->query($sql) or die($mysqli->error);
if($query->num_rows > 0)
    $data = $query->fetch_array();
else
    $data[0] = false;
//envio del ID encontrado
echo json_encode($data[0]);
 ?>