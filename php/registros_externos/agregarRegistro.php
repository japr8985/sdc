<?php 
$descripcion = $_POST['descripcion'];
$rev = $_POST['rev'];
$fecha_rev = $_POST['fecha'];
$codCliente = $_POST['codCliente'];
$disciplina = $_POST['disciplina'];
$fase = $_POST['fase'];
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
  '$fase',
	)";
	$data = array('Success' => false , 'Msg'=>'' );
if ($descripcion!='') {
	if ($rev!='') {
		if ($fecha_rev!='') {
			if ($codCliente!='') {
				if ($disciplina!='') {
					if ($fase!='') {
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
		$data['Msg'] ='Debe seleccionar una fase';	
	} 
else 
	$data['Msg'] ='Debe agregar una descripcion';
echo json_encode($data);
 ?>