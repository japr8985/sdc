<?php include("conexion/conexion.php");
$sql = "SELECT * FROM disciplina";
$query = $mysqli->query($sql);
$sql_fases = "SELECT * FROM fases ORDER BY FASE";
$fases = $mysqli->query($sql_fases);
 ?>
<?php include("header.php"); ?>

	<div class="container">
		<h1>Registros Externos</h1>
		<input type="text" id="id" hidden="true">
		<div class="form-group">
			<label for="codCliente">Cod. Cliente</label>
			<input type="text" class="form-control" id="codCliente">
		</div>
		<div class="form-group">
			<label for="descripcion">Descripcion</label>
			<input type="text" class="form-control" id="descripcion">
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-xs-3">
					<label for="rev">Rev.</label>
					<input type="text" class="form-control" id="rev">
				</div>
				<div class="col-xs-3">
					<label for="fecha">Fecha Rev.</label>
					<input type="date" class="form-control" id="fecha">
				</div>
				<div class="col-xs-3">
					<label for="disciplina">Disciplina</label>
					<select name="disciplina" id="disciplina" class="form-control">
						<option value=""></option>
						<?php while($r = $query->fetch_array()): ?>
							<option value="<?php echo $r[1]; ?>"><?php echo $r[0]; ?> </option>
						<?php endwhile; ?>
					</select>
				</div>
				<div class="col-xs-3">
				<label for="fase">Fases</label>
					<select id="fase" class="form-control">
						<option value=""></option>
						<?php while($f = $fases->fetch_array()): ?>
						<option value="<?php echo $f[0]; ?>"><?php echo $f[1]; ?></option>
						<?php endwhile; ?>
					</select>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-xs-offset-5">
					<button class="btn btn-default" onClick="buscar()">Buscar</button>
					<button class="btn btn-default" onClick="agregar()">Agregar Nuevo</button>
					<button class="btn btn-default" onClick="eliminar()">Eliminar</button>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-xs-offset-5">
					<button class="btn btn-default" onClick="inicio()">Inicio</button>
					<button class="btn btn-default" onClick="anterior()">Anterior</button>
					<button class="btn btn-default" onClick="siguiente()">Siguiente</button>
					<button class="btn btn-default" onClick="final()">Final</button>
				</div>
			</div>
		</div>
	</div>
	<script src="Assets/js/registros_externos.js"></script>
</body>
</html>