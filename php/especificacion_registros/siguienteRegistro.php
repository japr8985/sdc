<?php 
	ini_set('display_errors', 1);
	include ("../../conexion/conexion.php");
	$id = !empty($_REQUEST['id']) ? $_REQUEST['id'] : 0;
	$sql = "SELECT 	* FROM carac_doc WHERE id = (SELECT min(id) FROM carac_doc where id > ".$id.")";

$data = array(
			"Number" 				=> '',
			"id" 						=> $id,
			"CodPdvsa" 			=> '',
			"fase" 					=> '',
			"status" 				=> '',
			"actividad" 		=> '',
			"disciplina" 		=> '',
			"instalacion" 	=> '',
			"docPlano" 			=> '',
			"digitalFisico"	=> '');

	//ejecucion de consulta SQL
	if ($query = $mysqli->query($sql)) {
		//desgloce de la data
		$result = $query->fetch_array();
		//---------------------------------------
		$sql = "SELECT count(id) FROM carac_doc where id < ".$result['id'];
		if($query = $mysqli->query($sql)){
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
		}		
	}
	
	echo json_encode($data);
 ?>