<?php
include("../../conexion/conexion.php");
ini_set('display_errors', 1);
/*
|--------------------------------------
|        							CREACION DE USUARIO
| 1user, 2user, 3user tienen de pass 123456
|--------------------------------------
*/
/*
|--------------------------------------
|   RECIBIENDO VALORES
|--------------------------------------
*/
$nombre     = $_POST['name'];
$user       = $_POST['user'];
$pass       = $_POST['pass'];
$confirm    = $_POST['confirm'];
$correo     = $_POST['correo'].$_POST['email'];
$type       = $_POST['type'];
/*
|--------------------------------------
|   CONTRASEÑAS IGUALES
|--------------------------------------
*/
$data = array('Success' => false, 'Msg' => '', 'Error' => '');
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
        if(preg_match('/\s/',$pass) == 0){
            if(strlen($pass) > 5 and strlen($pass) < 17){
                /*
                |--------------------------------------
                |   ENCRIPTANDO CONTRASEÑA
                |--------------------------------------
                */
		      $pass = md5($pass);
              $sql = sprintf("INSERT INTO usuarios (username,password,correo,nombre,tipo) VALUES('%s','%s','%s','%s','%s')",
                    $mysqli->real_escape_string($user),
                    $mysqli->real_escape_string($pass),
                    $mysqli->real_escape_string($correo),
                    $mysqli->real_escape_string($nombre),
                    $mysqli->real_escape_string($type)
                    );
                if ($mysqli->query($sql)) {
                    $data['Success'] = true;
                    $data['Msg'] = "Usuario Creado Exitosamente";
                }
                else{
                    $data['Msg'] = 'Error al crear usuario.';
                    $data['Error'] = $mysqli->error;
                }
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