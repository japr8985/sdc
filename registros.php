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
			<div class="form-group" id="groupPdvsa">
				<label for="codPdvsa">
					CodPdvsa
				</label>
				<input type="text" class="form-control" id="codPdvsa">
			</div>
			<div class="form-group" id="groupDesc">
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
			<div class="row">
				<div class="col-xs-8">
					<div class="form-group">
						<label for="fecha">
							Fecha Revision/Emision
						</label>
						<div class="row">
							<div class="col-xs-3">
								<input type="date" class="form-control" id="fecha">
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-4">
					<div class="form-group">
						<label for="status">
							Status
						</label>
						<select class="form-control" id="status">
							<option value="ACTIVO">
								Activo
							</option>
							<option value="SUPERADO" selected>
								Superado
							</option>
						</select>
					</div>
				</div>
			</div>
		</form>
		<hr>
		<div class="row">
			<div class="col-xs-offset-3">
				<button class="btn btn-default" onClick="actualizar()">Actualizar</button>
				<button class="btn btn-default" onClick="buscar()">Buscar</button>
				<button class="btn btn-default" onClick="agregar()" disabled id="btnAgregar">Agregar Nuevo</button>
				<button class="btn btn-default" onClick="eliminar()">Eliminar</button>
				<button class="btn btn-default" onClick="limpiar()">Limpiar</button>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-xs-offset-4">
				<input type="text" class="numbers" id="numberToShow" readonly="true">
				<input type="text" class="numbers" id="totalnumbers" readonly="true" value="<?php echo $nums[0]; ?>">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-xs-offset-3">
				<button class="btn btn-default" onClick="inicio()">Inicio</button>
				<button class="btn btn-default" onClick="anterior()">Anterior</button>
				<button class="btn btn-default" onClick="siguiente()">Siguiente</button>
				<button class="btn btn-default" onClick="final()">Final</button>
			</div>
		</div>
	</div>


	<div class="modal fade" id="coincidencia" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<input type="text" class="numbers" readonly value="0" id="numberReg">/<input type="text" class="numbers" readonly value="0" id="totalReg">
				</div>
				<div class="modal-body">
				<input type="hidden" id="modalId" value="">
					<div class="row">
						<div class="col-sm-12">
							<label for="modalCodPdvsa">
								Cod. Pdvsa
							</label>
							<input type="text" class="form-control" id="modalCodPdvsa">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<label for="modalDescripcion">
								Descripcion
							</label>
							<textarea class="form-control" id="modalDescripcion"></textarea>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							<label for="modalRev">
								Rev
							</label>
							<input type="text" class="form-control" id="modalRev">
						</div>
						<div class="col-sm-4">
							<label for="modalDisc">
								Disciplina
							</label>
							<select id="modalDisc" class="form-control">
								<option value=""></option>
								<option value="H">Ambiente e higiene ocupacional </option>
								<option value="Q">Calidad </option>
								<option value="C">Civil </option>
								<option value="E">Electricidad </option>
								<option value="EC">Estimacion de Costos </option>
								<option value="G">General </option>
								<option value="O">Geodesia </option>
								<option value="GN">Gerencia </option>
								<option value="I">Instrumentacion </option>
								<option value="M">Mecanica </option>
								<option value="N">Naval </option>
								<option value="P">Proceso </option>
								<option value="PC">Procura </option>
								<option value="S">Seguridad </option>
								<option value="T">Telecomunicaciones </option>
								<option value="TB">Tuberias </option>
							</select>
						</div>
						<div class="col-sm-4">
							<label for="fase">
								Fase
							</label>
							<select id="modalFase" class="form-control">
								<option value=""></option>
								<option value="C">CONCEPTUALIZAR</option>
								<option value="D">DEFINIR</option>
								<option value="I">IMPLANTAR</option>
								<option value="O">OPERAR</option>
								<option value="V">VISUALIZAR</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							<label for="modalCliente">
								Cod. Cliente
							</label>
							<input type="text" class="form-control" id="modalCliente">
						</div>
						<div class="col-sm-4">
							<label for="modalFecha">
								Fecha
							</label>
								<input type="date" class="form-control" id="modalFecha">
						</div>
						<div class="col-sm-4">
							<label for="modalStatus">
								Status
							</label>
							<select class="form-control" id="modalStatus">
								<option value="ACTIVO">
									Activo
								</option>
								<option value="SUPERADO" selected>
									Superado
								</option>
							</select>
						</div>
					</div>
				</div>
				<div class="modal-footer">
				<button class="btn success" onclick="seleccionar()">Seleccionar</button>
				<button class="btn" onclick="reg_before()">Anterior</button>
				<button type="button" class="btn btn-primary" onclick="reg_next()">Siguiente</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<script src="Assets/js/registros.js"></script>
</body>
</html>