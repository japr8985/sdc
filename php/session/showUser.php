<?php 
ini_set('display_errors', 1);
include("../../conexion/conexion.php");

$id = $_POST['id'];

$sql = "SELECT * FROM usuarios where id = '$id'";
$query = $mysqli->query($sql);

echo json_encode($query->fetch_array());