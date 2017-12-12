<?php 
session_start();
if (!isset($_SESSION['username'])) {
    header('location:index.php');
    exit();
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>SAGD PROYECTO SOTO</title>
	<link rel="stylesheet" type="text/css" href="Assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="Assets/css/general.css">
	<link rel="stylesheet" href="Assets/css/jquery-confirm.min.css">
  	<script src="Assets/js/jquery-1-11-03.js"></script>
  	<script src="Assets/js/bootstrap.js"></script>
  	<script src="Assets/js/jquery-confirm.min.js"></script>

</head>
<body>
<header>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3">
				<a href="home.php">
					<img src="Assets/img/PDVSAlogo.png" alt="">
				</a>
			</div>
			<div class="col-md-offset-3">
				<div id="loader" hidden="true">
					<!-- Circulo de carga -->
				</div>
			</div>
			<div class="col-md-5">
				<a href="home.php" style="font-size: 48px;" class="text-center">
					<b>
						SAGD PROYECTO SOTO                        
                    </b>					
				</a>
			</div>
			<div class="col-md-3">
				<a href="#" data-toggle="modal" data-target="#show_current_user_modal">
					<?php if(isset($_SESSION)): ?>
						<h4>
							Usuario: <?php echo $_SESSION['nombre']; ?>
						</h4>
					<?php endif; ?>
				</a>
			</div>
		</div>
	</div>
</header>
<hr>

<!-- Modal -->
<div id="show_current_user_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Perfil del usuario: <?php echo $_SESSION['username']; ?></h4>
      </div>
      <div class="modal-body">
        <div class="row">
        	<div class="col-md-6">
        		<div class="form-group">
        			<label for="">Nombre</label>
        			<input type="text" class="form-control" value="<?php echo $_SESSION['nombre']; ?>">
        		</div>
        	</div>
        	<div class="col-md-6">
        		<div class="form-group">
        			<label for="">
        				Nombre de usuario
        			</label>
        			<input type="text" class="form-control" value="<?php echo $_SESSION['username']; ?>">
        		</div>
        	</div>
        </div>
        <hr>
        <div class="row">
        	<div class="col-md-6">
        		<div class="form-group">
        			<label for="">
        				Correo
        			</label>
        			<input type="text" class="form-control" value="<?php echo $_SESSION['email']; ?>">
        		</div>
        	</div>
        	<div class="col-md-6">
        		<div class="form-group">
        			<label for="">
        				Cedula
        			</label>
        			<input type="text" class="form-control" value="<?php echo $_SESSION['cedula'] ?>">
        		</div>
        	</div>
        </div>
        <hr>
        <div class="row">
        	<div class="col-md-6">
        		<div class="form-group">
        			<label for="">
        				Tipo de usuario
        			</label>
        			<input type="text" class="form-control" value="<?php echo $_SESSION['type']; ?>">
        		</div>
        	</div>
        	<div class="col-md-6">
        		<div class="form-group">
        			<label for="">
        				Cargo
        			</label>
        			<input type="text" class="form-control" value="<?php echo $_SESSION['cargo']; ?>">
        		</div>
        	</div>
        </div>
        <hr>
        <div class="row">
        	<div class="col-md-6">
        		<div class="form-group">
        			<label for="">
        				Tipo de sangre
        			</label>
        			<input type="text" class="form-control" value="<?php echo $_SESSION['sangre']; ?>">
        		</div>
        	</div>
        	<div class="col-md-6">
        		<div class="form-group">
        			<label for="">
        				Direccion
        			</label>
        			<input type="text" class="form-control" value="<?php echo $_SESSION['direccion']; ?>">
        		</div>
        	</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>