<?php include("conexion/conexion.php");
//--------------------------------------------
$sql = "SELECT * FROM disciplina";
$query = $mysqli->query($sql);
//--------------------------------------------
$sql_fases = "SELECT * FROM fases ORDER BY FASE";
$fases = $mysqli->query($sql_fases);
//--------------------------------------------
$sql_num_registros = "SELECT count(id) as Total from registros_total";
$result = $mysqli->query($sql_num_registros);
$nums = $result->fetch_array();
 ?>
<?php include("header.php"); ?>
	<input type="text" hidden="true" id="id" readonly="true">
	<div class="container">
		<h1>REGISTROS PDVSA - PROYECTO SOTO</h1>
		<form action="#" method="POST">
			<div class="form-group">
				<label for="codPdvsa">
					CodPdvsa
				</label>
				<input type="text" class="form-control" id="codPdvsa">
			</div>
			<div class="form-group">
				<label for="descripcion">
					Descripcion
				</label>
				<textarea type="text" class="form-control" id="descripcion" name="descripcion">
				</textarea> 
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-xs-4">
						<label for="rev">
						Rev
						</label>
						<input type="text" class="form-control" id="rev" name="rev" maxlength="1">
					</div>
					<div class="col-xs-4">
						<label for="disciplina">
							Disciplina
						</label>
						<select name="disciplina" id="disciplina" class="form-control">
							<option value=""></option>
							<?php while($r = $query->fetch_array()): ?>
								<option value="<?php echo $r[1]; ?>"><?php echo $r[0]; ?> </option>
							<?php endwhile; ?>
						</select>
					</div>
					<div class="col-xs-4">
						<label for="fase">
							Fase
						</label>
						<select name="fase" id="fase" class="form-control">
							<option value=""></option>
							<?php while($f = $fases->fetch_array()): ?>
								<option value="<?php echo $f[0]; ?>"><?php echo $f[1]; ?></option>
							<?php  endwhile;?>
						</select>
					</div>
				</div>
			</div><!--fin grupo de rev disciplina y fase -->
			<div class="form-group">
				<label for="codCliente">
					CodCliente
				</label>
				<input type="text" class="form-control" id="codCliente" name="codCliente">
			</div>
			<div class="form-group">
				<label for="rev_emi">
					Fecha Revision/Emision
				</label>
				<div class="row">
					<div class="col-xs-3">
						<input type="date" class="form-control" id="fecha">
					</div>
				</div>
			</div>
		</form>
		<hr>
		<div class="row">
			<div class="col-xs-offset-5">
				<button class="btn btn-default" onClick="buscar()">Buscar</button>
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
	<script src="Assets/js/registros.js"></script>
</body>
</html>