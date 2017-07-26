<?php include("header.php") ?>

	<div class="container">
		<div class="row box">
			<div class="col-xs-6">
				<a href="listaMaestra.php">
					<img src="Assets/iconos/lista_ maestra.png" class="icon">
					<h3>
						Lista Maestra
					</h3>
				</a>
			</div>
			<div class="col-xs-6">
				<a href="ubicacion.php">
					<img src="Assets/iconos/ubicacion.png" class="icon">
					<h3>
						Ubicacion de Registros (PDVSA)
					</h3>
				</a>
			</div>
		</div>
		<div class="row box">
			<div class="col-xs-6">
				<a href="especificacionPlanosDocumentos.php">
					<img src="Assets/iconos/especificaciones.png" class="icon">
					<h3>
						Especificaciones de Registros
					</h3>
				</a>	
			</div>
			<div class="col-xs-6">
				<a href="registros.php">
					<img src="Assets/iconos/registros_pdvsa.png" class="icon">
					<h3>
						Registros PDVSA
					</h3>
				</a>
			</div>
		</div>
		<div class="row box">
			<div class="col-xs-6">
				<a href="registros_externos.php">
					<img src="Assets/iconos/registros_externos.png" class="icon">
					<h3>
						Registros Externos
					</h3>
				</a>
			</div>
			<?php if($_SESSION['type'] == 'admin'):?>
                <div class="col-xs-6">
                    <a href="gestionUsuarios.php">
					<img src="Assets/iconos/usuarios.jpg" class="icon">
                        <h3>
                            Gestion De usuarios
                        </h3>
                    </a>
                </div>
		</div>
            <?php endif; ?>
		<div class="row box">
		    <div class="col-xs-6">
                <a href="#" onclick="cerrarSesion()">
		            <img src="Assets/iconos/logout.png" class="icon">
					<h3>
		                Cerrar Sesion
		            </h3>
                </a>
		    </div>
		</div>
	</div>
</body>
<script>
	function cerrarSesion(){
		console.log("php/session/logout.php");
		$.confirm({
			title:'Confirmar',
			content:'Desea realmente cerrar sesion?',
			confirm:function(){
				window.location.href = 'php/session/logout.php'
			},
			cancel:function(){}
		});
	}
</script>
</html>