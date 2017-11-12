<?php 
include("../../conexion/conexion.php");
ini_set('display_errors', 1);

$id = $_POST['id'];

$sql = "SELECT * FROM usuarios WHERE id = $id";

$query = $mysqli->query($sql);

$result = $query->fetch_array();

echo json_encode($result)
 ?>