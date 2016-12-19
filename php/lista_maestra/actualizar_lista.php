<?php 
include("../../conexion/conexion.php");
$cod = $_POST['id'];
$sql = "UPDATE registros_total SET status='SUPERADO' where codpdvsa = '$cod'";
$mysqli->query($sql);
 ?>