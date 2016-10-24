<?php 
	include ("../../conexion/conexion.php");
	$id = $_REQUEST['id'];
	$sql = "SELECT 
	carac_doc.*,
  	(SELECT disciplina.simbolo FROM disciplina where disciplina.disciplina = carac_doc.disciplina) AS disciplina
	FROM carac_doc 
	WHERE id = (SELECT max(id) FROM carac_doc WHERE id < $id)";
	//ejecucion de consulta SQL
	$query = $mysqli->query($sql) or die($mysqli->error);
	//desgloce de la data
	$result = $query->fetch_array();
	//codificacion e impresion del json
	$data = array(
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