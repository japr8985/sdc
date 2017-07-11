<?php 
include ("../../conexion/conexion.php");
//variables enviadas desde el formulario
$codPdvsa 		= $_POST['codPdvsa'];
$fase 			= $_POST['fase'];
$status 		= $_POST['status'];
$actividad		= $_POST['actividad'];
$instalacion 	= $_POST['instalacion'];
$doc_plano 		= $_POST['doc_plano'];
$digitalFisico 	= $_POST['digitalFisico'];
$disciplina 	= $_POST['disciplina'];
//arreglo de resupesta donde se enviaran los resultados
//de las validaciones y si la data es guardada correctamente
$data = array('Success' => false,'Msg' => '', 'Error' => '');
//consulta sql a ejecutar si la solicitud es completamente valida
$sql = "INSERT
INTO
   carac_doc(
    codpdvsa,
    fase,
    status,
    actividad,
    disciplina,
    instalacion,
    doc_plano,
    digital_fisico
  )
VALUES('$codPdvsa', '$fase', '$status','$actividad', '$disciplina', '$instalacion','$doc_plano','$digitalFisico')";
//funcion para limpiar caracteres especiales
function cleaner($val){
	/* eliminar todos los caracteres que puedan da;ar la consulta sql como '',"",","*/
	//eliminando las ,
	$val = str_replace(","," ", $val);
	// eliminando las comillas simples "'"
	$val = str_replace("'"," ", $val);
	//eliminando las comillas dobles '"'
	$val = str_replace('"'," ", $val);
	//retornando la variable sin caracteres que puedan da;ar la consulta
	return $val;
	}
$codPdvsa 		= cleaner($codPdvsa);
$fase 			= cleaner($fase);
$actividad		= cleaner($actividad);
$disciplina		= cleaner($disciplina);
$status 		= cleaner($status);
$instalacion 	= cleaner($instalacion);
$doc_plano 		= cleaner($doc_plano);
$digitalFisico 	= cleaner($digitalFisico);
if ($codPdvsa !='') {
	if ($fase!='') {
		if ($actividad !='') {
			if ($disciplina!='') {
				if ($status!='') {
					if ($instalacion!='') {
						if ($mysqli->query($sql)) {
							$data['Success'] = true;
							$data['Msg'] = 'Plano/Documento guardado con exito';
						}
						else{
							$data['Msg'] = 'Error al guardar. '.$mysqli->error;
						}
					}
					else{
						$data['Msg'] = 'Instalacion en blanco';
					}
				}
				else{
					$data['Msg'] ='Status no seleccionado';
				}
			}
			else{
				$data['Msg'] ='Disciplina no seleccionada';
			}
		}
		else{
			$data['Msg'] = 'Actividad no seleccionada';
		}
	}
	else{
		$data['Msg'] ='Fase no seleccionada';
	}
}
else{
	$data['Msg'] = 'Codigo PDVSA en blanco';
}
echo json_encode($data);
 ?>