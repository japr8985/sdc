<?php
ini_set('display_errors', 1);
include('../../conexion/conexion.php');

session_start();

$data = array('Success' => false,'Msg' => '','Error' => '' );

$user = $_POST['user'];
$pass = md5($_POST['pass']);

$sql = sprintf("SELECT * FROM usuarios WHERE username = '%s' and password = '%s'",
	$mysqli->real_escape_string($user),
	$mysqli->real_escape_string($pass));

$query = $mysqli->query($sql);

if ($query->num_rows == 1) {

	$result = $query->fetch_array();
    
	$_SESSION['username'] = $result['username'];
	$_SESSION['nombre'] = $result['nombre'];
	$_SESSION['type'] = $result['tipo'];
    
	$data['Success'] = true;
	$data['Msg'] = 'Bienvenido '.$result['nombre'];
	}
else{
	$data['Msg'] = utf8_encode('Informacion incorrecta'); //utf8_encode('Usuario o contraseña incorrecta');
	$data['Error'] = $mysqli->error;
}
echo json_encode($data);
?>