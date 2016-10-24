<?php 
include ("../../conexion/conexion.php");
//variables enviadas desde el formulario
$codPdvsa 	= $_POST['codPdvsa'];
$descripcion= $_POST['descripcion'];
$rev 		= $_POST['rev'];
$disciplina = $_POST['disciplina'];
$fase 		= $_POST['fase'];
$status 	= $_POST['status'];
$codCliente = $_POST['codCliente'];
$fecha		= $_POST['fecha'];
//arreglo de resupesta donde se enviaran los resultados
//de las validaciones y si la data es guardada correctamente
$data = array('Success' => false,'Msg' => '', 'Error' => '');
//consulta sql a ejecutar si la solicitud es completamente valida
$sql = "INSERT
INTO
   registros_total(
    codpdvsa,
    descripcion,
    rev,
    fecha_rev,
    codcliente,
    disciplina,
    status,
    fase
  )
VALUES('$codPdvsa', '$descripcion', '$rev', '$fecha','$codCliente', '$disciplina', '$status','$fase')";
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
$descripcion 	= cleaner($descripcion);
$rev 					= cleaner($rev);
$disciplina 	= cleaner($disciplina);
$fase 				= cleaner($fase);
$status 			= cleaner($status);
$codCliente 	= cleaner($codCliente);
$fecha  			= cleaner($fecha);
if ($codPdvsa !='') {
	if ($descripcion !='') {
		if ($rev != '' AND ($rev == '1' or $rev =='0')) {
			if ($disciplina!='') {
				if ($fase !='') {
					if ($status!='') {
						if ($codCliente !='') {
							if ($fecha!='') {
								//validacion si la consulta es ejecutada con exito
								if ($mysqli->query($sql)) {
									$data['Success'] = true;
									$data['Msg'] = 'Registro guardado con exito';
									}
								else{
									$data['Msg'] = 'Imposible de guardar. ';
									$data['Error'] = $mysqli->error;
									}//fin error de consulta
								}//fin if fecha
							else{
								$data['Msg'] = 'No posee fecha';
								}//fin else fecha
							}//fin if codCliente
						else{
							$data['Msg'] = 'No posee codigo de cliente';
							}
						}//fin if status
					else{
						$data['Msg'] = 'No posee status';
						}//fin else status
					}//fin if fase
				else{
					$data['Msg'] = 'No posee fase';
					}//fin else fase
				}//fin if disciplina
			else{
				$data['Msg'] = 'No posee disciplina';
				}
			}//fin if rev
		else{
			$data['Msg'] = 'No posee numero de revision o se ha ingresado un numero no valido';
			}//fin else rev
		}//fin if descripcion
	else{
		$data['Msg'] = 'No posee descripcion en blanco';
		}//fin else descripcion
	}//fin if codpdvsa
else{
	$data['Msg'] = 'No posee codigo en blanco';
	}//fin else codpdvsa
echo json_encode($data);
 ?>