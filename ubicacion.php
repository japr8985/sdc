<?php 
	include("conexion/conexion.php"); 
	$sql_fases = "SELECT * FROM fases ORDER BY FASE";
	$fases = $mysqli->query($sql_fases);
	//--------------------------------------------
	$sql_num_registros = "SELECT count(id) as Total from ubicacion";
	$result = $mysqli->query($sql_num_registros);
	$nums = $result->fetch_array();
?>
<?php include("header.php"); ?>

	<input type="text" hidden="true" id="id">
	<div class="container">
		<h1>Ubicacion de planos y documentos - Proyecto Soto</h1>
		<div class="form-group">
			<div class="row">
				<div class="col-xs-4">
					<label for="ciudad">Ciudad</label>
					<input type="text" id="ciudad" class="form-control">
				</div>
				<div class="col-xs-4">
					<label for="sede">Sede</label>
					<input type="text" id="sede" class="form-control">
				</div>
				<div class="col-xs-4">
					<label for="departamento">Departamento</label>
					<input type="text" id="departamento" class="form-control">
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-xs-2">
					<label for="nProyecto">Nro. Proyecto</label>
					<input type="text" class="form-control" id="nProyecto">
				</div>
				<div class="col-xs-2">
					<label for="year">Año</label>
					<input type="text" class="form-control" id="year">
				</div>
				<div class="col-xs-2">
					<label for="nCaja">Nro. Caja</label>
					<input type="text" class="form-control" id="nCaja">
				</div>
				<div class="col-xs-2">
					<label for="codCarpeta">Cod. Carpeta Principal</label>
					<input type="text" class="form-control" id="codCarpeta">
				</div>
				<div class="col-xs-2">
					<label for="subCarpeta">Cod. Subcarpeta</label>
					<input type="text" class="form-control" id="subCarpeta">
				</div>
				<div class="col-xs-2">
					<label for="nDoc">Nro. Documento</label>
					<input type="text" class="form-control" id="nDoc">
				</div>
			</div>
		</div>
		<div class="form-group">
			<label for="codPdvsa">Cod. Pdvsa</label>
			<input type="text" class="form-control" id="codPdvsa">
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-xs-6">
					<label for="fase">Fases</label>
					<select id="fase" class="form-control">
						<option value=""></option>
						<?php while($f = $fases->fetch_array()): ?>
						<option value="<?php echo $f[0]; ?>"><?php echo $f[1]; ?></option>
						<?php endwhile; ?>
					</select>
				</div>
				<div class="col-xs-6">
					<label for="rev">Rev</label>
					<input type="text" class="form-control" id="rev">
				</div>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-xs-offset-4">
				<button class="btn btn-default" onClick="buscar()">Buscar</button>
				<button class="btn btn-default" onClick="actualizar()">Actualizar</button>
				<button class="btn btn-default" onClick="agregar()">Agregar Nuevo</button>
				<button class="btn btn-default" onClick="eliminar()">Eliminar</button>
				<button class="btn btn-default" onClick="limpiar()">Limpiar</button>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-xs-offset-5">
				<input type="text" class="numbers" id="numberToShow" readonly="true">
				<input type="text" class="numbers" id="totalnumbers" readonly="true" value="<?php echo $nums[0]; ?>">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-xs-offset-5">
				<button class="btn btn-default" onClick="inicio()">Inicio</button>
				<button class="btn btn-default" onClick="anterior()">Anterior</button>
				<button class="btn btn-default" onClick="siguiente()">Siguiente</button>
				<button class="btn btn-default" onClick="final()">Final</button>
			</div>
		</div>
	</div>
	<script src="Assets/js/ubicacion.js"></script>
</body>
</html>