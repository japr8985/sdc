<?php
ini_set('display_errors', 1);
include("../../conexion/conexion.php");
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
    if (!empty($nombre)) {
        //usuarios sin espacio en blanco
        if (preg_match('/\s/',$user) == 0 && !empty($user)) {
            //contraseña sin espacio en blanco
            if(preg_match('/\s/',$pass) == 0){
                if(strlen($pass) > 5 and strlen($pass) < 17){
                    //expresion regular para emails
                    $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/";
                    if (preg_match($pattern,$correo)) {
                        $sql = "SELECT count(id) from usuarios WHERE correo = '$correo'";
                        //echo $sql;
                        $query = $mysqli->query($sql);
                        $num_rows = $query->fetch_array();
                        if ($num_rows == 0) {
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
                                    
                                    if($mysqli->error == "Duplicate entry '$user' for key 'username'"){
                                       $data['Msg'] = "Usuario duplicado. Imposible de crear"; 
                                    }
                                    else{
                                        $data['Msg'] = 'Error al crear usuario.';
                                        $data['Error'] = $mysqli->error;
                                    }
                                        
                                }
                        }
                        else
                            $data['Msg'] = "Ya existe un usuario con este correo '$correo'";
                            $data['Campo'] ="correo" ;
                    
                    }
                    else{
                        $data['Msg'] = 'Formato de correo invalido';
                        $data['Campo'] = "correo";
                    }
                }
                else{
                   $data['Msg'] = 'La clave debe tener de 6 a 16'; 
                   $data['Campo'] = "pass";
                }
            }
            else
                $data['Msg'] = 'La clave no debe poseer espacios en blancos'; 
                $data['Campo'] = "pass";
        }
        else{
            $data['Msg'] = "El nombre de usuario no puede poseer espacios en blanco";
            $data['Campo'] = "username";
        }
    }
    else{
        $data['Msg'] = "Nombre no puede estar en blanco";
        $data['Campo'] = "name";
    }
    
}
else{
    $data['Msg'] = utf8_encode('Contraseñas no coinciden');
}
echo json_encode($data);
?>