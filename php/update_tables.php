<?php 
ini_set('display_errors', 1);
include('../conexion/conexion.php');
$sql = "SELECT * from disciplina";
$result = $mysqli->query($sql) or die($mysqli->error);
while ($r = $result->fetch_array()) {
	
	$sql = "UPDATE carac_doc SET disciplina = '".$r[1]."' WHERE disciplina ='".$r[0]."'";
	echo $sql.'<br>';
	$mysqli->query($sql);
}
 ?>