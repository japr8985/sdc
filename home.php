<?php include("header.php") ?>

	<div class="container">
		<div class="row box">
			<div class="col-xs-6">
				<a href="listaMaestra.php">
					<h3>
					Lista Maestra
					</h3>
				</a>
			</div>
			<div class="col-xs-6">
				<a href="ubicacion.php">
					<h3>
						Ubicacion de Registros (PDVSA)
					</h3>
				</a>
			</div>
		</div>
		<div class="row box">
			<div class="col-xs-6">
				<a href="especificacionPlanosDocumentos.php">
					<h3>
						Especificaciones de Registros
					</h3>
				</a>	
			</div>
			<div class="col-xs-6">
				<a href="registros.php">
						<h3>
							Registros PDVSA
						</h3>
					</a>
			</div>
		</div>
		<div class="row box">
			<div class="col-xs-6">
				<a href="registros_externos.php">
					<h3>
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