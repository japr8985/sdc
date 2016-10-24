<?php 
	include ("../../conexion/conexion.php");
	//capturando el valor enviado
	$cod = $_REQUEST['data'];
	//consulta
	$sql = "SELECT
  carac_doc.*,
  (SELECT disciplina.simbolo FROM disciplina where disciplina.disciplina = carac_doc.disciplina) AS disciplina
FROM
  carac_doc
WHERE
  codpdvsa LIKE '%$cod%' 
LIMIT 0, 1";
	//ejecucion de la consulta
	$query = $mysqli->query($sql);
	//desgloce de la data
	$result = $query->fetch_array();
	//armando arreglo
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
	//imprimiendo json
	echo json_encode($data);
 ?>