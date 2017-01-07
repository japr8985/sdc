<?php 
include("../../conexion/conexion.php");

//verifica envio de informacion por post
$cod = $_POST['codigo'];
//hace la busqueda de lo enviado por post donde solo se selecciona el id y se limita a 1 resultado
$sql = "SELECT id FROM lista_maestra WHERE codpdvsa like '%$cod%' Limit 0,1";
//ejecucion de query
$query = $mysqli->query($sql);
$data = $query->fetch_array();
//envio del ID encontrado
echo json_encode($data[0]);
 ?>