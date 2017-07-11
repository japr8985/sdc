<?php 
include("../../conexion/conexion.php");
ini_set('display_errors', 1);

/*
|--------------------------------------
|   RECIBIENDO VALORES
|--------------------------------------
*/
$id 		= intval($_POST['id']);
$nombre     = $_POST['name'];
$user       = $_POST['user'];
$pass       = $_POST['pass'];
$confirm    = $_POST['confirm'];
$correo     = $_POST['correo'].$_POST['email'];
$type       = $_POST['type'];
$data = ['Success' => false, 'Msg' => ''];
if($pass == $confirm){
	/*
    |--------------------------------------
    |   CONDICIONES
    |       * EL NOMBRE DE USUARIO NO PUEDE TENER ESPACIO EN BLANCO
    |       * LA CLAVE NO PUEDE TENER ESPACIOS EN BLANCO
    |       * LA CLAVE DEBE SER MAYOR A 5 CARACTERES Y MENOS A 17
    |           [6,16]
    |--------------------------------------
    */
	if (preg_match('/\s/',$user) == 0) {
		if (preg_match('/\s/',$pass) == 0) {
			if (strlen($pass) > 5 and strlen($pass) < 17) {
				//expresion regular para emails
                $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/";
                if (preg_match($pattern,$correo)) {
                	/*
					|--------------------------------------
					|   ENCRIPTANDO CONTRASEÑA
					|--------------------------------------
					*/
					$pass = md5($pass);
					$sql = sprintf("UPDATE usuarios 
						SET username = '%s', 
							password = '%s', 
							correo = '%s', 
							nombre = '%s', 
							tipo = '%s' 
							WHERE id = '%d'
						",
						$mysqli->real_escape_string($user),
			    		$mysqli->real_escape_string($pass),
			    		$mysqli->real_escape_string($correo),
			    		$mysqli->real_escape_string($nombre),
			    		$mysqli->real_escape_string($type),
			    		$mysqli->real_escape_string($id));
					if ($mysqli->query($sql)) {
						$data['Success'] = true;
						$data['Msg'] = "Usuario Actualizado Exitosamente";
					}
					else{
						$data['Msg'] = 'Error al actualizar usuario.';
						$data['Error'] = $mysqli->error;
					}
                }
                else
                	$data['Msg'] = 'El correo no puede estar en blanco';
			}
			else
				$data['Msg'] = 'La clave debe tener de 6 a 16'; 
		}
		else
			$data['Msg'] = 'La clave no debe poseer espacios en blancos'; 
		}
	else{
		$data['Msg'] = "El nombre de usuario no puede poseer espacios en blanco";
	}
}
else{
    $data['Msg'] = utf8_encode('Contraseñas no coinciden');
}
echo json_encode($data);

 ?>