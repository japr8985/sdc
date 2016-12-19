<?php 
	include ("../../conexion/conexion.php");
	$id = $_POST['id'];
	$sql = "SELECT * FROM registros_total WHERE id = (SELECT min(id) FROM registros_total where id > $id)";
	//ejecucion de consulta SQL
	$query = $mysqli->query($sql) or die($mysqli->error);
	if ($query->num_rows > 0) {
		//desgloce de la data
		$result = $query->fetch_array();
	
		//----------------------------------------
		$sql = "SELECT count(id) FROM registros_total where id < ".$id;
		if ($query = $mysqli->query($sql)) {
			$num =$query->fetch_array();
		$num = $num[0]+1;
		//----------------------------------------
		//echo $result['Descripcion'];
		//codificacion e impresion del json
		$data = array(
			"Number"		=> $num,
			"ID" 			=> $result['ID'],
			"CodPdvsa" 		=> $result['CodPdvsa'],
			"Descripcion" 	=> utf8_encode($result['Descripcion']),
			"Rev" 			=> $result['Rev'],
			"Fecha_Rev" 	=> $result['Fecha_Rev'],
			"CodCliente" 	=> $result['CodCliente'],
			"Disciplina" 	=> $result['Disciplina'],
			"Status" 		=> $result['Status'],
			"Fase" 			=> $result['Fase']);
			echo json_encode($data);
			} 
		else {
			echo $sql;
			echo '<br>';
			echo $mysqli->error;
			}
		} 
	else {
			# code...
		}

 ?>