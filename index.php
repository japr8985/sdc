<?php 
session_start();
if (isset($_SESSION['username'])) {
    header('location:home.php');
    exit();
}
 ?>
<html>
    <head>
        <title>Sistema De Control Documental</title>
        <link rel="stylesheet" type="text/css" href="Assets/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="Assets/css/general.css">
        <link rel="stylesheet" href="Assets/css/jquery-confirm.min.css">
        <script src="Assets/js/jquery-1-11-03.js"></script>
        <script src="Assets/js/bootstrap.js"></script>
        <script src="Assets/js/jquery-confirm.min.js"></script>
        <script src="Assets/js/login.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row vertical-center">
                <div class="col-xs-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <img src="Assets/img/PDVSAlogo.png" alt="">
                        </div>
                        <form action="php/session/login.php" method="POST" class="form-group">
                            <div class="panel-body">
                           <!--Nombre de Usuario-->
                                <label for="username">
                                    Nombre de Usuario
                                </label>
                                <input type="text" name="user" id="username" class="form-control" placeholder="Nombre del usuario">
                                <hr>
                            <!--Contraseña del usuario-->
                                <label for="pass">
                                    Contraseña
                                </label>
                                <input type="password" name="pass" id="pass" class="form-control" placeholder="******">
                            </div>
                            <div class="panel-footer">
                            <input type="submit" class="btn btn-default" value="Iniciar Session">
                               <!-- Botones Para iniciar sesion/reset formulario-->
                            <input type="reset" class="btn btn-warning" value="Cancelar">
                            <a href="#" onclick="window.open('manual.docx','_blank');" class="btn btn-success">
                                Manual de Usuario
                            </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>