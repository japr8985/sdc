<?php 
$host 	= 'localhost';
$user 	= 'root';
$pass	= '';
$db		= 'scd';
$mysqli = new mysqli($host,$user,$pass,$db);
if ($mysqli->connect_error) {
	echo "Error: ".$mysqli->connect_error;
	}
 ?>