<?php 
include ("../../conexion/conexion.php");
//variables enviadas desde el formulario
$codPdvsa 	= $_POST['codPdvsa'];
$descripcion= $_POST['descripcion'];
$rev 		= isset($_POST['rev']) ? $_POST['rev'] : 'A';
$disciplina = $_POST['disciplina'];
$fase 		= $_POST['fase'];
$codCliente = $_POST['codCliente'];
$fecha 		= isset($_POST['fecha']) ? new DateTime($_POST['fecha']) : new DateTime();
$fecha 		= $fecha->format('Y-m-d');
//arreglo de resupesta donde se enviaran los resultados
//de las validaciones y si la data es guardada correctamente
$data = array('Success' => false,'Msg' => '', 'Error' => '');
//consulta sql a ejecutar si la solicitud es completamente valida
//buscando registro anterior
$sql = "SELECT codpdvsa, rev from registros_total WHERE codpdvsa = '$codPdvsa' ORDER BY fecha_rev";
$query = $mysqli->query($sql);
$num_row = $query->num_rows;
if ($num_row > 0) {
	//si ya existe ese registro entonce actualizar todos a superado
	$sql = "UPDATE registros_total SET status = 'SUPERADO' WHERE codpdvsa = '$codPdvsa'";
	//realizar actualizacion
	$mysqli->query($sql) or die($mysqli->error);
	//insertar nuevo registro
    //pero antes verificar el numero de la revision
    $rev_old = $query->fetch_array();
    if (ord($rev_old[1]) < ord($rev)) {
        $sql = "INSERT INTO
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
                VALUES('$codPdvsa', '$descripcion', '$rev', '$fecha','$codCliente', '$disciplina', 'ACTIVO','$fase')";
        if ($mysqli->query($sql)) {
            $data['Success'] = true;
            $data['Msg'] = "Registro guardado exitosamente";
        } else {
            $data['Msg'] = "Fallo al registar.";
            $data['Error'] = $mysqli->error;
        }
    } else {
        $data['Msg'] = "Fallo al registar.";
            $data['Error'] = "Ya se tiene una version mas reciente de este registro";
    }
    
	

    } 
else {
	//si no existe ningun registro agregar el nuevo con status activo
	$sql = sprintf("INSERT
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
VALUES('%s', '%s', '%s', '$fecha','%s', '%s', 'ACTIVO','%s')",
$mysqli->real_escape_string($codPdvsa),
$mysqli->real_escape_string($descripcion),
$mysqli->real_escape_string($rev),
$mysqli->real_escape_string($codCliente),
$mysqli->real_escape_string($disciplina),
$mysqli->real_escape_string($fase));
	if ($mysqli->query($sql)) {
		$data['Success'] = true;
		$data['Msg']= "Registro ingresado con exito";
	} else {
		$data['Msg'] = "Error al registrar. ".$mysqli->error;
	}
	
}

echo json_encode($data);
 ?>