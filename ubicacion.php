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
				<div class="form-group">
			<div class="row">
				<div class="col-xs-4">
					<label for="modalCiudad">Ciudad</label>
					<input type="text" id="modalCiudad" class="form-control">
				</div>
				<div class="col-xs-4">
					<label for="modalSede">Sede</label>
					<input type="text" id="modalSede" class="form-control">
				</div>
				<div class="col-xs-4">
					<label for="modalDep">Departamento</label>
					<input type="text" id="modalDep" class="form-control">
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-xs-2">
					<label for="modalNP">Nro. Proyecto</label>
					<input type="text" class="form-control" id="modalNP">
				</div>
				<div class="col-xs-2">
					<label for="modalYear">Año</label>
					<input type="text" class="form-control" id="modalYear">
				</div>
				<div class="col-xs-2">
					<label for="modalCaja">Nro. Caja</label>
					<input type="text" class="form-control" id="modalCaja">
				</div>
				<div class="col-xs-2">
					<label for="modalCarpeta">Cod. Carpeta Principal</label>
					<input type="text" class="form-control" id="modalCarpeta">
				</div>
				<div class="col-xs-2">
					<label for="modalSubCarpeta">Cod. Subcarpeta</label>
					<input type="text" class="form-control" id="modalSubCarpeta">
				</div>
				<div class="col-xs-2">
					<label for="modalNDoc">Nro. Documento</label>
					<input type="text" class="form-control" id="modalNDoc">
				</div>
			</div>
		</div>
		<div class="form-group">
			<label for="modalCodPdvsa">Cod. Pdvsa</label>
			<input type="text" class="form-control" id="modalCodPdvsa">
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-xs-6">
					<label for="modalFase">Fases</label>
					<select id="modalFase" class="form-control">
						<option value=""></option>
						<option value="C">CONCEPTUALIZAR</option>
						<option value="D">DEFINIR</option>
						<option value="I">IMPLANTAR</option>
						<option value="O">OPERAR</option>
						<option value="V">VISUALIZAR</option>
					</select>
				</div>
				<div class="col-xs-6">
					<label for="modalRev">Rev</label>
					<input type="text" class="form-control" id="modalRev">
				</div>
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
	<script src="Assets/js/ubicacion.js"></script>
</body>
</html>