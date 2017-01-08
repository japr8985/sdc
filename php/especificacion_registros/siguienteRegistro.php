<?php 
	include ("../../conexion/conexion.php");
	$id = $_REQUEST['id'];
	$sql = "SELECT 
	*  	
	 FROM carac_doc WHERE id = (SELECT min(id) FROM carac_doc where id > $id)";
	//ejecucion de consulta SQL
	$query = $mysqli->query($sql) or die($mysqli->error);
	//desgloce de la data
	$result = $query->fetch_array();
	//---------------------------------------
	$sql = "SELECT count(id) FROM carac_doc where id < ".$result['id'];
	$query = $mysqli->query($sql);
	$num =$query->fetch_array();
	$num = $num[0]+1;
	//----------------------------------------
	$data = array(
		"Number"		=> $num,
		"id" 			=> $result['id'],
		"CodPdvsa" 		=> $result['codpdvsa'],
		"fase" 			=> $result['fase'],
		"status" 		=> $result['status'],
		"actividad" 	=> $result['actividad'],
		"disciplina" 	=> $result['disciplina'],
		"instalacion" 	=> utf8_encode($result['instalacion']),
		"docPlano" 	=> $result['doc_plano'],
		"digitalFisico"=> $result['digital_fisico']);
	echo json_encode($data);
 ?>