<?php 
	include('conexion/conexion.php'); 
	$sql_fases = "SELECT * FROM fases ORDER BY FASE";
	$fases = $mysqli->query($sql_fases);
	//-----------------------------------------------
	$sql_actividad = "SELECT * FROM actividad";
	$actividades = $mysqli->query($sql_actividad);
	//-----------------------------------------------
	$sql_disciplinas = "SELECT * FROM disciplina";
	$disciplinas = $mysqli->query($sql_disciplinas);
	//------------------------------------------------
	$sql_num_registros = "SELECT count(id) as Total from carac_doc";
	$result = $mysqli->query($sql_num_registros);
	$nums = $result->fetch_array();
	?>
<?php include('header.php'); ?>
<body>
	<input type="text" id="id" hidden="true">
	<div class="container">
	<h1>Especificacion de Planos y Documentos - Proyecto Soto</h1>
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
			<div class="col-xs-offset-4">
				<button class="btn btn-default" onClick="buscar()">Buscar</button>
				<button class="btn btn-default" onClick="actualizar()">Actualizar</button>
				<button class="btn btn-default" onClick="agregar()">Agregar</button>
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
	    <div class="row">
        <div class="container">
            <div class="col-md-3 ">
                <a href="home.php" style="font-size: xx-large;">
                    <span>&larr;</span>
                    Regresar
                </a>
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
							<label for="modalcodpdvsa">
								Cod. Pdvsa
							</label>
							<input type="text" class="form-control" id="modalcodpdvsa">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							<label for="modalFase">
								Fases
							</label>
							<select name="" id="modalFase" class="form-control">
								<option value=""></option>
								<option value="C">CONCEPTUALIZAR</option>
								<option value="D">DEFINIR</option>
								<option value="I">IMPLANTAR</option>
								<option value="O">OPERAR</option>
								<option value="V">VISUALIZAR</option>
							</select>
						</div>
						<div class="col-sm-4">
							<label for="modalStatus">
								Status
							</label>
							<select name="" id="modalStatus" class="form-control">
									<option value="Activo">
										Activo
									</option>
									<option value="Superado" selected>
										Superado
									</option>
								</select>
							</select>
						</div>
						<div class="col-sm-4">
							<label for="modalActividad">
								Actividad
							</label>
							<select name="" id="modalActividad" class="form-control">
								<option value=""></option>
								<option value="1">Comunicacion</option>
								<option value="2">Planificacion y control</option>
								<option value="3">Ingenieria</option>
								<option value="4">Gestion de la calidad</option>
								<option value="5">Contratacion</option>
								<option value="6">Procura</option>
								<option value="7">Comunicacion</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
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
					</div>
					<div class="row">
						<div class="col-sm-12">
							<label for="modalInstalacion">
								Instalacion
							</label>
							<input type="text" class="form-control" id="modalInstalacion">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<label for="modalDocPlano">
								Documento/Plano
							</label>
							<select id="modalDocPlano" class="form-control">
								<option value="D">Documento</option>
								<option value="P">Plano</option>
							</select>
						</div>
						<div class="col-sm-6">
							<label for="modalDigFis">
								Digital/Fisico
							</label>
							<select  id="modalDigFis" class="form-control">
								<option value="D">Digital</option>
								<option value="Fisico">Fisico</option>
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
	<script src="Assets/js/especificacionesPlanosDocumentos.js"></script>
	
</body>
</html>