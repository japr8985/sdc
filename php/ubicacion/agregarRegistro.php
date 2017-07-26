<?php 
include ("../../conexion/conexion.php");

//campos enviados
$ciudad 			= $_POST['ciudad'];
$sede 				= $_POST['sede'];
$departamento = $_POST['departamento'];
$nproyecto 		= $_POST['nproyecto'];
$year 				= $_POST['year'];
$ncaja 				= $_POST['ncaja'];
$codcarpeta 	= $_POST['codcarpeta'];
$subcarpeta 	= $_POST['subcarpeta'];
$ndoc 				= $_POST['ndoc'];
$codpdvsa 		= $_POST['codpdvsa'];
$fase 				= $_POST['fase'];
$rev 					= $_POST['rev'];

//arreglo de resupesta donde se enviaran los resultados
//de las validaciones y si la data es guardada correctamente
$data = array('Success' => false,'Msg' => '', 'Error' => '','Campo' => '');

if (preg_match('/\s/', $codpdvsa) == 0) {
	if (preg_match('/\s/', $rev) == 0) {
		//consulta sql
$sql ="INSERT
INTO
  ubicacion(
    ciudad,
    sede,
    dpto,
    nproyecto,
    YEAR,
    ncaja,
    codcarprinc,
    codsubcarp,
    ndoc,
    codpdvsa,
    fase,
    rev
  )
VALUES('$ciudad','$sede','$departamento',$nproyecto,$year,$ncaja,'$codcarpeta','$subcarpeta',$ndoc,'$codpdvsa','$fase',$rev)";

if ($ciudad!='') {
	if ($sede!='') {
		if ($departamento!='') {
			if ($nproyecto!='') {
				if ($ncaja !='') {
					if ($codcarpeta!='') {
						if ($subcarpeta!='') {
							if ($ndoc!='') {
								if ($codpdvsa!='') {
									if ($fase!='') {
										if ($rev!='') {
											if ($mysqli->query($sql)) {
												$data['Success'] = true;
												$data['Msg'] = "Registro agregado de manera exitosa";
											} else {
												$data['Msg'] = "Problemas al ingresar un nuevo registro";
												$data['Error'] = $mysqli->error;
											}
											
										} else {
											$data['Msg'] = "Revision no puede estar en blanco";
										}
										
										}
									else {
										$data['Msg'] = "Debe seleccionar una fase";
									}
									
									} 
								else {
									$data['Msg'] = "El Cod. Pdvsa no puede estar en blanco";
								}
								
								} 
							else{
								$data['Msg'] = "Num. Documento no puede estar en blanco y debe ser un numero";
								}
							
						} else {
							$data['Msg'] = "El codigo de una subcarpeta no puede estar en blanco";
						}
						
						}
					else {
						$data['Msg'] = "El codigo de la carpeta principal no puede estar en blanco";
					}
					
					} 
				else{
					$data['Msg'] = "Num. Caja no puede estar vacio y debe ser un numero";
				}
				
				} 
			else {
				$data['Msg'] = "El numero del proyecto no puede estar vacio y debe ser un numero";
			}
			
		} 
		else {
			$data['Msg'] = "Departamento no puede estar vacio";
		}
		
		}
	else {
		$data['Msg'] = "Sede no puede estar vacia";
		}
	} 
else {
	$data['Msg'] = "Ciudad no puede estar vacia";
	}
	}
	else{
		$data['Error'] = 'Campo Rev es requerido';
		$data['Campo'] = 'rev';
	}
}
else{
	$data['Msg'] = 'Campo Cod. Pdvsa es requerido';
	$data['Campo'] = 'codpdvsa';
}

echo json_encode($data);
 ?>