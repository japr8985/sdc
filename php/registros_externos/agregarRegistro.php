<?php 
ini_set('display_errors', 1);
include('../../conexion/conexion.php');
include("../registros/rev_valor.php");
$descripcion = $_POST['descripcion'];
$rev = $_POST['rev'];
$fecha_rev = isset($_POST['fecha']) ? $_POST['fecha'] : '';
$fecha_rev = new DateTime($fecha_rev);
$fecha_rev = $fecha_rev->format('Y-m-d');
$codCliente = $_POST['codCliente'];
$disciplina = $_POST['disciplina'];
$fase = $_POST['fase'];

	$data = array('Success' => false , 'Msg'=>'' );
if ($descripcion!='') {
	if ($rev!='') {
		$sql = "SELECT rev from registros_externos WHERE codCliente = '$codCliente' ORDER BY fecha_rev DESC Limit 0,1";
		$result = $mysqli->query($sql);
        $rev_old = $result->fetch_array();
        if (revValor($rev) > revValor($rev_old[0])) {
        	if ($fecha_rev!='') {
			if ($codCliente!='') {
				if ($disciplina!='') {
					if ($fase!='') {
						$sql ="INSERT
							INTO
							  registros_externos(
							    descripcion,
							    rev,
							    fecha_rev,
							    codCliente,
							    disciplina,
							    fase
							  )
							VALUES(
							  '$descripcion',
							  '$rev',
							  '$fecha_rev',
							  '$codCliente',
							  '$disciplina',
							  '$fase'
								)";
						if ($mysqli->query($sql)) {
							$data['Success'] = true;
							$data['Msg'] ='Registro externo guardado con exito';
						} 
						else
							$data['Msg'] ='Error al guardar. '.$mysqli->error;
					} 
					else 
					 $data['Msg'] ='Debe seleccionar una fase';
				} 
				else
					$data['Msg'] ='Debe seleccionar una disciplina';				
			} 
			else
				$data['Msg'] ='Debe seleccionar un codigo de cliente';			
		} 
		else
			$data['Msg'] ='Debe seleccionar una fecha';	
        }
        else
        	$data['Msg'] ='Debe agregar una revision mayor';		
		}	 
	else 
		$data['Msg'] ='Debe seleccionar una fase';	
	} 
else 
	$data['Msg'] ='Debe agregar una descripcion';
echo json_encode($data);
 ?>