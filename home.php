<?php include("header.php") ?>

	<div class="container">
		<div class="row box">
			<div class="col-xs-6">
				<a href="listaMaestra.php">
					<h3>
					<img src="Assets/iconos/lista_ maestra.png" class="icon">
					Lista Maestra
					</h3>
				</a>
			</div>
			<div class="col-xs-6">
				<a href="ubicacion.php">
					<h3>
					<img src="Assets/iconos/ubicacion.png" class="icon">
						Ubicacion de Registros (PDVSA)
					</h3>
				</a>
			</div>
		</div>
		<div class="row box">
			<div class="col-xs-6">
				<a href="especificacionPlanosDocumentos.php">
					<h3>
					<img src="Assets/iconos/especificaciones.png" class="icon">
						Especificaciones de Registros
					</h3>
				</a>	
			</div>
			<div class="col-xs-6">
				<a href="registros.php">
						<h3>
						<img src="Assets/iconos/registros_pdvsa.png" class="icon">
							Registros PDVSA
						</h3>
					</a>
			</div>
		</div>
		<div class="row box">
			<div class="col-xs-6">
				<a href="registros_externos.php">
					<h3>
						<img src="Assets/iconos/registros_externos.png" class="icon">
						Registros Externos
					</h3>
				</a>
			</div>
		</div>
		<div class="row box">
		    <?php if($_SESSION['type'] == 'admin'):?>
                <div class="col-xs-6">
                    <a href="gestionUsuarios.php">
                        <h3>
                            Gestion De usuarios
                        </h3>
                    </a>
                </div>
            <?php endif; ?>
		    <div class="col-xs-6">
                <a href="#" onclick="cerrarSesion()">
		            <h3>
						<img src="Assets/iconos/logout.png" class="icon">
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