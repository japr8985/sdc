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

if($pass == $confirm){
	if (preg_match('/\s/',$user) == 0) {
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
	else{
		$data['Msg'] = "El nombre de usuario no puede poseer espacios en blanco";
	}
}
else{
    $data['Msg'] = utf8_encode('Contraseñas no coinciden');
}
echo json_encode($data);

 ?>