<?php include('header.php'); ?>
<div class="container">
	<div class="row">
		<div class="col-xs-4">
			<button onClick="cargar_lista_maestra()" class="btn btn-default">Cargar lista Maestra</button>
		</div>
		<div class="col-xs-4">
			<button onClick="buscarCodigo()" class="btn btn-default btn-disabled" id="btnSearch" disabled="true">Buscar Codigo</button>
		</div>
		<div class="col-xs-4">
			<input type="text" class="form-control" id="searchCode" disabled="true">
		</div>
	</div>
	<hr>
	<div class="listaBox">
		<table class="table table-condensed table-hover" >
			<thead>
				<tr>
					<td></td>
					<td>Codigo PDVSA</td>
					<td>Descripcion</td>
					<td style="width: 50px;">Rev.</td>
					<td style="width: 110px;">Fase</td>
					<td style="width: 100px;">Disciplina</td>
					<td>Fecha de Revision/Emision</td>
				</tr>
			</thead>
				<tbody>
				</tbody>
		</table>
	</div>
	<hr>
	<div class="row">
		<div class="col-xs-2">
			<button class="btn btn-default" onClick="inicio()">Inicio</button>
		</div>
		<div class="col-xs-2">
			<button class="btn btn-default" onClick="fin()">Fin</button>
		</div>
		<div class="col-xs-2">
			<button class="btn btn-default" onClick="anterior()">Anterior</button>
		</div>
		<div class="col-xs-2">
			<button class="btn btn-default" onClick="siguiente()">Siguiente</button>
		</div>
		<div class="col-xs-2">
			<button class="btn btn-default" onClick="limpiar()">Limpiar</button>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-xs-offset-5">
			<input type="text" class="numbers" id="numberToShow" readonly="true">
			/
			<input type="text" class="numbers" id="totalnumbers" readonly="true" value="0">
		</div>
	</div>
	<hr>
	<div class="row">

		<div class="col-xs-2">
			<button class="btn btn-default" onClick="imprimir()">Imprimir</button>
		</div>
		<div class="col-xs-2">
			<button class="btn btn-default" onClick="filtradoPorFechas()">Reporte Por filtrado de fecha</button>
		</div>
	</div>
<div class="modal fade" id="filtradoPorFechasModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">
                &times;
            </span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Lista Maestra - Filtrado Por fecha</h4>
      </div>
      <div class="modal-body">
		<div class="input-group">
			<label for="desde">
				Desde
			</label>
			<input type="date" id="desde" class="form-control">
		</div>
		<div class="input-group">
			<label for="hasta">
				Hasta
			</label>
			<input type="date" id="hasta" class="form-control">
		</div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary" onClick="generarFiltradoPorFecha()" data-dismiss="modal">Generar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
</div>







<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">
                &times;
            </span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Lista Maestra - Registro</h4>
      </div>
      <div class="modal-body">
				<label for="cod">C&oacute;digo Pdvsa</label>
				<input type="text" id="cod" class="form-control">
				<hr>
				<label for="desc">Descripci&oacute;n</label>
				<textarea id="desc" class="form-control"></textarea>
				<hr>
				<label for="revision">Revisi&oacute;n</label>
				<input type="text" id="revision" class="form-control">
				<label for="disc">Disciplina</label>
				<input type="text" id="disc" class="form-control">
				<label for="fr">Fecha Revision/Emision</label>
				<input type="date" id="fr" class="form-control">
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
</div>
		<script src="Assets/js/listaMaestra.js"></script>
</body>
</html>
