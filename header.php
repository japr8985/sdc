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
				<a href="home.php">
					<h3 class="text-center">
						SAGD PROYECTO SOTO
					</h3>
				</a>
			</div>
			<div class="col-md-1">
				<a href="#">
					<?php if(isset($_SESSION)): ?>
						<h4>
							<?php echo $_SESSION['nombre']; ?>
						</h4>
					<?php endif; ?>
				</a>
			</div>
		</div>
	</div>
</header>
<hr>