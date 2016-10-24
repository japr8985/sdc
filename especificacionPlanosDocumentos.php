<?php 
	include('conexion/conexion.php'); 
	$sql_fases = "SELECT * FROM fases ORDER BY FASE";
	$fases = $mysqli->query($sql_fases);
	$sql_actividad = "SELECT * FROM actividad";
	$actividades = $mysqli->query($sql_actividad);
	$sql_disciplinas = "SELECT * FROM disciplina";
	$disciplinas = $mysqli->query($sql_disciplinas);
	?>
<?php include('header.php'); ?>
<body>
	<input type="text" id="id" hidden="true">
	<div class="container">
		<div class="form-group">
			<label for="codPdvsa">CodPdvsa</label>
			<input type="text" class="form-control" id="codPdvsa">
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-xs-4">
					<label for="fase">
						Fases
					</label>
					<select name="fase" id="fase" class="form-control">
						<option value=""></option>
						<?php while($f = $fases->fetch_array()): ?>
							<option value="<?php echo $f[0]; ?>"><?php echo $f[1]; ?></option>
						<?php  endwhile;?>
					</select>
				</div>
				<div class="col-xs-4">
					<label for="status">
						Status
					</label>
					<select name="status" id="status" class="form-control">
					<option value="Activo">Activo</option>
					<option value="Superado">Superado</option>
				</select>
				</div>
				<div class="col-xs-4">
					<label for="actividad">
						Actividad
					</label>
					<select id="actividad" class="form-control">
						<option value=""></option>
						<?php while($a = $actividades->fetch_array()): ?>
							<option value="<?php echo $a[0]; ?>"><?php echo $a[1]; ?></option>
						<?php endwhile; ?>
					</select>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label for="disciplina">
				Disciplina
			</label>
			<select id="disciplina" class="form-control">
				<option value=""></option>
				<?php while($d = $disciplinas->fetch_array()): ?>
					<option value="<?php echo $d[1]; ?>"><?php echo $d[0]; ?></option>
				<?php endwhile; ?>
			</select>
		</div>
		<div class="form-group">
			<label for="instalacion">
				Instalacion
			</label>
			<input type="text" id="instalacion" class="form-control">
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-xs-6">
					<label for="docPlano">Documento/Plano</label>
					<select id="docPlano" class="form-control">
						<option value="D">Documento</option>
						<option value="P">Plano</option>
					</select>
				</div>
				<div class="col-xs-6">
					<label for="digitalFisico">Digital/Fisico</label>
					<select name="" id="digitalFisico" class="form-control">
						<option value="D">Digital</option>
						<option value="Fisico">Fisico</option>
					</select>
				</div>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-xs-offset-5">
				<button class="btn btn-default" onClick="buscar()">Buscar</button>
				<button class="btn btn-default" onClick="agregar()">Agregar</button>
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
	<script src="Assets/js/especificacionesPlanosDocumentos.js"></script>
</body>
</html>